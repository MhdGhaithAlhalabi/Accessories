<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:customer-api', ['except' => ['index','index2','feedbackRead','destroy']]);
    }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => ['required'],
            'customer_id' => ['required'],
        ]);

        if ($validator->fails()) {

            return Response()->json($validator->getMessageBag(), 400);
        }

        $product = Feedback::create([
            'message' => $request->message,
            'customer_id' => $request->customer_id,
            'status' => 0
        ]);

        return Response()->json('feedback send', 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
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
