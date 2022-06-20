<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Allmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!empty($this->data)) {
            $address = env("MAIL_FROM_ADDRESS");
            $name = env("MAIL_FROM_NAME");

            switch ($this->data['type']) {
                case 1:
                    //client registration mail
                    return $this->view('mail.client_reg_mail')
                                ->from($address, $name)
                                ->subject('OKTAT Registration');                    
                    break;
                case 2:
                    //student registration mail
                    return $this->view('mail.student_reg_mail')
                                ->from($address, $name)
                                ->subject('OKTAT Registration');                    
                    break;

                case 3:
                    //edit class mail
                    return $this->view('mail.edit_class_mail')
                                ->from($address, $name)
                                ->subject('Edit Class');                    
                    break;

                case 4:
                    //add course mail
                    return $this->view('mail.add_course_mail')
                                ->from($address, $name)
                                ->subject('Course Added') 
                                ->with([ 'course_name' => $this->data['course_name'] ]);                                 
                    break;

                case 5:
                    //change password mail
                    return $this->view('mail.change_password_mail')
                                ->from($address, $name)
                                ->subject('Password Updated') 
                                ->with([ 'firstname' => $this->data['firstname'],'lastname' => $this->data['lastname'] ]);                                 
                    break;

                case 6:
                    //contact-us mail
                    return $this->view('mail.contactus_mail')
                                ->from($address, $name)
                                ->subject('Oktat Contact Us') 
                                ->with([ 'name' => $this->data['name'] ]);                                 
                    break;
                
                case 7:
                    //slider mail
                    return $this->view('mail.advertise_mail')
                                ->from($address, $name)
                                ->subject('Oktat Advertise') 
                                ->with([ 'firstname'=>$this->data['firstname'] ,'lastname'=>$this->data['lastname'] ,'slider_name'=>$this->data['slider_name']]);                                 
                    break;

                 case 8:
                    //Student admission mail
                    return $this->view('mail.student_adminssion_mail')
                                ->from($address, $name)
                                ->subject('Oktat Admission Confirmation') 
                                ->with(
                                    [
                                        'student_name' => $this->data['student_name'],
                                        'class_name' => $this->data['class_name'],
                                        'main_course_name' => $this->data['main_course_name'],
                                        'sub_course_name' => $this->data['sub_course_name'],
                                        'child_course_name' => $this->data['child_course_name'],
                                        'address' => $this->data['address'],
                                        'timing' => $this->data['timing'],
                                        'total_course_fees' => $this->data['total_course_fees'],
                                        'discount' => $this->data['discount'],
                                        'your_price_by_oktat' => $this->data['your_price_by_oktat'],
                                        'addmission_fees' => $this->data['addmission_fees'],
                                        'remaining_amount' => $this->data['remaining_amount'],
                                        'payment_mode' => $this->data['payment_mode'],
                                    ]
                            );                                 
                    break;

                    case 11:
                    //Client admission mail
                    return $this->view('mail.student_adminssion_mail_toclass')
                                ->from($address, $name)
                                ->subject('Oktat Admission Confirmation') 
                                ->with(
                                    [
                                        'student_name' => $this->data['student_name'],
                                        'class_name' => $this->data['class_name'],
                                        'main_course_name' => $this->data['main_course_name'],
                                        'sub_course_name' => $this->data['sub_course_name'],
                                        'child_course_name' => $this->data['child_course_name'],
                                        'address' => $this->data['address'],
                                        'timing' => $this->data['timing'],
                                        'total_course_fees' => $this->data['total_course_fees'],
                                        'discount' => $this->data['discount'],
                                        'your_price_by_oktat' => $this->data['your_price_by_oktat'],
                                        'addmission_fees' => $this->data['addmission_fees'],
                                        'remaining_amount' => $this->data['remaining_amount'],
                                        'payment_mode' => $this->data['payment_mode'],
                                    ]
                            );                                 
                    break;

                    case 9:
                    //send mail to student/client after two days of admission
                    return $this->view('mail.aftertwodaysto_student_mail')
                                ->from($address, $name)
                                ->subject('Oktat Admission Finalized') 
                                ->with(
                                    [
                                        'student_name' => $this->data['student_name'],
                                        'class_name' => $this->data['class_name'],
                                        'main_course_name' => $this->data['main_course_name'],
                                        'sub_course_name' => $this->data['sub_course_name'],
                                        'child_course_name' => $this->data['child_course_name'],
                                        'address' => $this->data['address'],
                                        'timing' => $this->data['timing'],
                                        'total_course_fees' => $this->data['total_course_fees'],
                                        'discount' => $this->data['discount'],
                                        'your_price_by_oktat' => $this->data['your_price_by_oktat'],
                                        'addmission_fees' => $this->data['addmission_fees'],
                                        'remaining_amount' => $this->data['remaining_amount'],
                                        'payment_mode' => $this->data['payment_mode'],
                                    ]
                            );                                 
                    break;

                    case 10:
                    //send mail to student/client after two days of admission
                    return $this->view('mail.aftertwodaysto_client_mail')
                                ->from($address, $name)
                                ->subject('Oktat Admission Finalized') 
                                ->with(
                                    [
                                        'owner_name' => $this->data['owner_name'],
                                        'student_name' => $this->data['student_name'],
                                        'class_name' => $this->data['class_name'],
                                        'main_course_name' => $this->data['main_course_name'],
                                        'sub_course_name' => $this->data['sub_course_name'],
                                        'child_course_name' => $this->data['child_course_name'],
                                        'address' => $this->data['address'],
                                        'timing' => $this->data['timing'],
                                        'total_course_fees' => $this->data['total_course_fees'],
                                        'discount' => $this->data['discount'],
                                        'your_price_by_oktat' => $this->data['your_price_by_oktat'],
                                        'addmission_fees' => $this->data['addmission_fees'],
                                        'remaining_amount' => $this->data['remaining_amount'],
                                        'payment_mode' => $this->data['payment_mode'],
                                    ]
                            );                                 
                    break;

                default:
                    # code...
                    break;
            }
        }
        
    }
}
