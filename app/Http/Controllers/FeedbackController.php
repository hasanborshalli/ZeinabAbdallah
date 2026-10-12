<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'feedback' => 'required|string',
            'feedback_ar' => 'required|string',
        ]);

        Feedback::create($fields);

        return redirect()->route('admin.feedbacks.page')->with('success', 'Feedback added successfully.');
    }

    public function editFeedback(Request $request, Feedback $feedback)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'feedback' => 'required|string',
            'feedback_ar' => 'required|string',
        ]);

        $feedback->update($fields);

        return redirect()->route('admin.feedbacks.page')->with('success', 'Feedback updated successfully.');
    }

    public function deleteFeedback(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedbacks.page')->with('success', 'Feedback Deleted successfully.');
    }
}
