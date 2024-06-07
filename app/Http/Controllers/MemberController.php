<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
        $members = $memberQuery->paginate(5);

        return Inertia::render('Members/List', [
            'members' => $members,
            'search' => $searchTerm ?? ''
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
        Member::create($request->validated());
        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $games = $member->games()->orderBy('played_at', 'desc')->get();
        $averageScore = $games->avg('pivot.score');
        $highestScore = $games->max('pivot.score');
        $highestScoreGame = $games->where('pivot.score', $highestScore)->first();

        return Inertia::render('Members/Profile', [
            'member' => $member,
            'averageScore' => $averageScore,
            'highestScore' => $highestScore,
            'highestScoreDate' => $highestScoreGame->played_at ?? '',
            'recentGames' => $games,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return Inertia::render('Members/Edit', ['member' => $member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->validated());
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function leaderboard()
    {
        $topMembers = Member::with('games')
            ->get()
            ->sortByDesc(function ($member) {
                return $member->games->avg('pivot.score');
            })
            ->take(10);

        return Inertia::render('Leaderboard', ['topMembers' => $topMembers]);
    }
}
