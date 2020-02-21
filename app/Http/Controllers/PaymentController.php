<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseEnroll;
use App\Transaction;
use Carbon\Carbon;

use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $paymentData = json_decode(json_encode($paymentDetails, FALSE))->data;
        $status = $paymentDetails['message'];

        if (!$status)
            return;

        $student_id = $paymentData->metadata->student_id;
        $course_id = $paymentData->metadata->course_id;
        $amount = $paymentData->amount; // Amount in kobo amount/100 = amount in naira

        $transaction_id = $paymentData->id;
        $reference = $paymentData->reference;
        $card = $paymentData->authorization->channel;
        $card_brand = $paymentData->authorization->brand;

        // TimeStamp
        $paid_at = $paymentData->paid_at;
        $created_at = $paymentData->created_at;

        // Adding transaction result to the database table -- transactions
        $transaction = new Transaction;
        $transaction->student_id = $student_id;
        $transaction->course_id = $course_id;
        $transaction->amount = $amount;
        $transaction->transaction_id = $transaction_id;
        $transaction->reference = $reference;
        $transaction->card = $card;
        $transaction->card_brand = $card_brand;

        $transaction->paid_at = Carbon::make($paid_at);
        $transaction->created_at = Carbon::make($created_at);

        $transaction->save();

        // Enroll the student to the course
        // Checking If Student has already enrolled for this course
        $enroll = CourseEnroll::where('course_id', $course_id)->where('student_id', $student_id)->exists();
        $course = Course::find($course_id);

        // If Not enrolled
        if (!$enroll) {
            // Enroll Student
            $courseEnroll  = new CourseEnroll;
            $courseEnroll->student_id = $student_id;
            $courseEnroll->course_id = $course_id;
            $courseEnroll->save();

            return redirect(route('courseDetails', $course))->with("message", "Congratulations, you have been successfully enrolled to {$course->title}.");
        } else {
            // Notify Student that he/she has been enrolled
            return redirect(route('courseDetails', $course))->with("error", "You have been enrolled in this course already.");
        }
    }
}