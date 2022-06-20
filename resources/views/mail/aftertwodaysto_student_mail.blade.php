<html lang="en-US">
    	<head>
    		<meta charset="utf-8">
    	</head>
    	<body>
            <h4>Dear {{$student_name ? $student_name : ""}},</h4>
            <p>This is to inform you that 2 days have passed since your Admission process and hence, as per our refund and cancellation, your Admission is hereby irrevocably confirmed and finalized.</p>
            <p>Once again, we are sharing the admission details for your convenience:</p>
            
            <p><b>Student Name</b>:<span>{{$student_name ? $student_name : ""}}</span></p>
            <p><b>Coaching Class Name</b>:<span>{{$class_name ? $class_name : ""}}</span></p>
            <p><b>Main Course Name</b>:<span>{{$main_course_name ? $main_course_name : ""}}</span></p>
            <p><b>Sub Course Name</b>:<span>{{$sub_course_name ? $sub_course_name : ""}}</span></p>
            <p><b>Sub Child Course Name</b>:<span>{{$child_course_name ? $child_course_name : "N/A"}}</span></p>
            <p><b>Address</b>:<span>{{$address ? $address : ""}}</span></p>
            <p><b>Timing</b>:<span>{{$timing ? $timing : ""}}</span></p>
            <p><b>Total Course Fees</b>:<span>₹{{$total_course_fees ? $total_course_fees : ""}}</span></p>
            <p><b>Discount</b>:<span>₹{{$discount ? $discount : ""}}</span></p>
            <p><b>Your Price By Oktat</b>:<span>₹{{$your_price_by_oktat ? $your_price_by_oktat : ""}}</span></p>
            <p><b>Admission Fees</b>:<span>₹{{$addmission_fees ? $addmission_fees : ""}}</span></p>
            <p><b>Remaining Fees Will Be Payable At Class By Students</b>:<span>₹{{$remaining_amount ? $remaining_amount : ""}}</span></p>
            <p><b>Payment Mode</b>:<span>{{$payment_mode ? $payment_mode : ""}}</span></p>
            <p>Congratulations and all the best!</p>
            <p>For any query or doubt, feel free to reach out to us via mail or call.</p>
            
            <p>Mail: <b>info@oktat.in</b></p>
            <p>Call:<b>72111 13006</b> OR <b>72111 13007</b></p>

            <h4>Our best,</h4>
            <p>Team Oktat</p>

    	</body>
</html>
