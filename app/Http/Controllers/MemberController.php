<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Initialize the member query
        $memberQuery = Member::query();

        // Apply search filter if present
        $searchTerm = request('search');
        $this->applySearch($memberQuery, $searchTerm);

        // Paginate the results and pass to the view
        $members = $memberQuery->paginate(20);

        return Inertia::render('Members/List', [
            'members' => $members,
            'search' => $searchTerm ?? '',
            'success' => session('success')
        ]);
    }

    protected function applySearch(Builder $query, $search)
    {
        // If search term is provided, apply the filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Members/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['joined_at'] = now();

        Member::create($validatedData);

        return redirect()->route('members.index')->with('success', 'Member created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $games = $member->games()->orderBy('played_at', 'desc')->get();
        $averageScore = number_format($games->avg('pivot.score'), 2);
        $highestScore = $games->max('pivot.score');
        $highestScoreGame = $games->where('pivot.score', $highestScore)->first();
        $highestGameName = $highestScoreGame ? $highestScoreGame->name : null;

        // Calculate the total number of games played
        $totalGames = $games->count();

        return Inertia::render('Members/Profile', [
            'member' => $member,
            'averageScore' => $averageScore,
            'highestScore' => $highestScore,
            'highestScoreDate' => $highestScoreGame ? $highestScoreGame->played_at : null,
            'highestGameName' => $highestGameName,
            'recentGames' => $games,
            'totalGames' => $totalGames,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return Inertia::render('Members/Edit', [
            'member' => $member,
            'originalPhone' => $member->original_phone
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->validated());
        return response()->json([
            'success' => 'Member updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return to_route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function leaderboard()
    {
        $topMembers = Member::select('id', 'name')
            ->withCount([
                'games as total_games' => function ($query) {
                    // Count the total number of games for each member
                    $query->has('members', '>=', 2);
                },
                'games as average_score' => function ($query) {
                    // Calculate the average score for each member
                    $query->select(DB::raw('AVG(score)'))
                        ->has('members', '>=', 2);
                }
            ])
            ->orderByDesc('average_score')
            ->limit(10)
            ->get()
            ->map(function ($member) {
                // Convert null average score to null
                $member->average_score = $member->average_score ?? null;
                return $member;
            });

        return Inertia::render('LeaderBoard', ['topMembers' => $topMembers]);
    }
}
