<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\GenericM;
use App\StudentM;
use App\Mail\Allmail;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command call everyday for after 2 days passed admission than send mail to student and class.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get All enrolled course that not scheduled not completed
        $data = GenericM::getAllData('tbl_enroll_course',array('isschedule'=>0));
        $current_date = date('Y-m-d H:i:s');
        if (!$data->isEmpty()) {
            $updata['isschedule'] = 1;
            foreach ($data as $key => $value) {
                $new_date = date('Y-m-d H:i:s', strtotime($value->date. ' + 2 days'));
                if ($current_date >= $new_date) {


                    //send mail to student/client after two days of admission
                    $row = StudentM::getCourseData($value->timeslot_id);
                    $student_row = GenericM::getSingleRecord('tbl_student_registration','*',array('id'=>$value->student_id));
                    $class_row = GenericM::getSingleRecord('tbl_class_registration','*',array('id'=>$value->class_id));
                    $student_all_type = [
                        'type' => 9,
                        'student_name' => $student_row->firstname." ".$student_row->lastname,
                        'class_name' => $row->class_name,
                        'main_course_name' => $row->main_course_name,
                        'sub_course_name' => $row->sub_course_name,
                        'child_course_name' => $row->child_course_name ? $row->child_course_name : "N/A",
                        'address' => $row->address,
                        'timing' => date("g:i A", strtotime($row->start_time))." To ".date("g:i A", strtotime($row->end_time)),
                        'total_course_fees' => $row->price,
                        'discount' => $value->student_original_discount_value,
                        'your_price_by_oktat' => $value->student_addmission_fees,
                        'addmission_fees' => $value->admission_fees_selection_value,
                        'remaining_amount' => ($value->student_addmission_fees - $value->admission_fees_selection_value),
                        'payment_mode' => "Paytm",
                    ];

                    $class_all_type = [
                        'type' => 10,
                        'owner_name' => $class_row->firstname." ".$class_row->lastname,
                        'student_name' => $student_row->firstname." ".$student_row->lastname,
                        'class_name' => $row->class_name,
                        'main_course_name' => $row->main_course_name,
                        'sub_course_name' => $row->sub_course_name,
                        'child_course_name' => $row->child_course_name ? $row->child_course_name : "N/A",
                        'address' => $row->address,
                        'timing' => date("g:i A", strtotime($row->start_time))." To ".date("g:i A", strtotime($row->end_time)),
                        'total_course_fees' => $row->price,
                        'discount' => $value->student_original_discount_value,
                        'your_price_by_oktat' => $value->student_addmission_fees,
                        'addmission_fees' => $value->admission_fees_selection_value,
                        'remaining_amount' => ($value->student_addmission_fees - $value->admission_fees_selection_value),
                        'payment_mode' => "Paytm",
                    ];                    
                    // dd($student_all_type);
                    if (!empty($student_row) && !empty($student_all_type)) {
                        \Mail::to($student_row->email)->send(new Allmail($student_all_type));
                        if (!empty($class_row)) {
                            \Mail::to($class_row->email)->send(new Allmail($class_all_type));
                        }
                        //update in enroll table{isschedule:1}
                        GenericM::updateData('tbl_enroll_course',array('id'=>$value->id),$updata);
                    }
                }else
                {
                    echo "no scheduled data found.";
                }
            }
        }else
        {
            echo "no scheduled data found.";
        }
    }
}
