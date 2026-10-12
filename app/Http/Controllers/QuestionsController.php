<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function addquestion(Request $request)
    {
        $fields = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer' => 'required|string',
            'answer_ar' => 'required|string',
        ]);

        Question::create($fields);

        return redirect()->route('admin.questions.page')->with('success', 'Question added successfully.');
    }
    public function editquestion(Request $request, Question $question)
    {
        $fields = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer' => 'required|string',
            'answer_ar' => 'required|string',
        ]);

        $question->update($fields);

        return redirect()->route('admin.questions.page')->with('success', 'Question updated successfully.');
    }
    public function deletequestion(Question $question)
    {
        $question->delete();  
          return redirect()->route('admin.questions.page')->with('success', 'Question Deleted successfully.');
    }
}