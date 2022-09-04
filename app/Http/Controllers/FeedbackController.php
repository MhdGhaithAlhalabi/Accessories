<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $feedbacks = Feedback::with('customer')->where('status', '=', '0')->get();
        return view('feedback.show_feedback',compact('feedbacks'));
    }
    public function index2()
    {
        $feedbacks = Feedback::with('customer')->where('status', '=', '1')->get();
        return view('feedback.show_feedback2',compact('feedbacks'));
    }
    public function feedbackRead(Feedback $feedback)
    {
        $feedback->status = 1;
        $feedback->save();
        return redirect()->route('feedbackView.index')->with('message','تم قرائة الرسالة');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbackReadView.index')
            ->with('message', 'تم حذف الرسالة');
    }
}
