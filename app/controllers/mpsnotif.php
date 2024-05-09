<?php

class Mpsnotif extends Controller {
    public function sendnotifmps(){
        $data = $this->model('Mps_model')->getMpstoNotify();
        
        if(sizeof($data) > 0){
            $this->notifmps($data);
        }
    }
    
    public function infonotif(){
        $data = $this->model('Mps_model')->getInfoDueDate();
        
        if(sizeof($data) > 0){
            $this->sendnotifinfo($data);
        }
    }
    
    public function notifmps($data){
        $from    = "admin@awsi.co.id";
        $tomail  = "purchasing@awsi.co.id";
        $subject = "Notif MPS Project";    
        
        
        $mailBody = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
            
                th, td {
                    border: 1px solid #ddd;
                    text-align: left;
                    padding: 8px;
                    color:black
                }
            
                tr:nth-child(even){background-color: #f2f2f2}
            
                th {
                    background-color: #4CAF50;
                    color: white;
                }
            </style>
        </head>
        <body>
            <p>Dear Bapak/Ibu,</p>
            Mohon untuk melakukan pengecekan Activity MPS Project Berikut :<br>
            <table>
            <thead>
            <tr>
              <th>MPS Project</th>
              <th>Activity</th>
              <th>Plan Date</th>
            </tr>
          </thead>
          <tbody>
            ";
            
        foreach($data as $row){
            $mailBody .= "
            <tr> 
              <td>".$row['namaproject']."</td>
              <td>".$row['activity_name']."</td>
              <td>".$row['plan_date']."</td>
            </tr>";  
        }    
            
            $mailBody .= "</tbody></table><br><p>Terimakasih.</p>
        </body>
        </html>
        ";
        
        $headers = "From:" . $from ."\r\n";    
        $headers .= "Content-type: text/html". "\r\n";
        
        $elist = array();
        
        $recipients = $this->model('Emailnotif_model')->getAll();
        
        if(sizeof($recipients) > 0){
            foreach($recipients as $row){
                 $elist[] = $row['email'];
            }
            
            $maillist = join($elist, ",");
            
            mail($maillist,$subject,$mailBody,$headers); 
            // mail('husnulmub@gmail.com,army@awsi.co.id,admin@awsi.co.id',$subject,$mailBody,$headers); 
        }
    }
    
    public function sendnotifinfo($data){
        $from    = "admin@awsi.co.id";
        $tomail  = "purchasing@awsi.co.id";
        $subject = "Notif Papan Informasi";    
        
        
        $mailBody = "
        <!DOCTYPE html>
        <html lang='en'>
        <html>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <style type='text/css'>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
            
                th, td {
                    border: 1px solid #ddd;
                    text-align: left;
                    padding: 8px;
                    color:black
                }
            
                tr:nth-child(even){background-color: #f2f2f2}
            
                th {
                    background-color: #4CAF50;
                    color: white;
                }
            </style>
        </head>
        <body>
            <p>Dear Bapak/Ibu,</p>
            Mohon untuk melakukan pengecekan papan informasi, informasi berikut sudah mendekati/melewati due date :<br>
            <table>
            <thead>
            <tr>
              <th>Department</th>
              <th>Information</th>
              <th>Due Date</th>
            </tr>
          </thead>
          <tbody>
            ";
            
        foreach($data as $row){
            $mailBody .= "
            <tr> 
              <td>".$row['deptsection']."</td>
              <td>".$row['description']."</td>
              <td style='width:100px;'>".$row['duedate']."</td>
            </tr>";  
        }    
            
            $mailBody .= "</tbody></table><br><p>Terimakasih.</p>
        </body>
        </html>
        ";
        
        $headers = "From:" . $from ."\r\n";    
        $headers .= "Content-type: text/html". "\r\n";
        
        $elist = array();
        
        $recipients = $this->model('Emailnotif_model')->getAll();
        
        if(sizeof($recipients) > 0){
            foreach($recipients as $row){
                 $elist[] = $row['email'];
            }
            
            $maillist = join($elist, ",");
            
            mail($maillist,$subject,$mailBody,$headers); 
            // mail('husnulmub@gmail.com,army@awsi.co.id,admin@awsi.co.id',$subject,$mailBody,$headers); 
        }
    }
    
    public function kirimnotif($data){
        $toemail = 'husnulmub@gmail.com'; //email penerima
        $pesan   = 'Email notif project activity'; //isi email
        
        $email    = ''; //email pengirim, silahkan diganti dengan email sendiri
        $password = ''; //password gmail
        
        $to_id = $toemail;
        $message = $pesan;
        $subject = 'Notif MPS Project';
        $mail = new PHPMailer;
        $mail->FromName = "AWSI-ERP System";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $password;
        $mail->addAddress($to_id);
        $mail->addAddress('husnulm15@gmail.com');
        $mail->addAddress('army@awsi.co.id');
        $mail->Subject = $subject;
        // $mail->msgHTML($message);
        $mail->IsHTML(true);
         
        
        $mailBody = "
        <html>
        <head>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
            
                th, td {
                    border: 1px solid #ddd;
                    text-align: left;
                    padding: 8px;
                    color:black
                }
            
                tr:nth-child(even){background-color: #f2f2f2}
            
                th {
                    background-color: #4CAF50;
                    color: white;
                }
            </style>
        </head>
        <body>
            <p>Dear Bapak/Ibu,</p>
            Mohon untuk melakukan pengecekan Activity MPS Project Berikut :<br>
            
            <thead>
            <tr>
              <th>MPS Project</th>
              <th>Activity</th>
              <th>Plan Date</th>
            </tr>
          </thead>
          <tbody>
            ";
            
        foreach($data as $row){
            $mailBody .= "
            <tr> 
              <td>".$row['namaproject']."</td>
              <td>".$row['activity_name']."</td>
              <td>".$row['plan_date']."</td>
            </tr>";  
        }    
            
            $mailBody .= "</tbody></table><br><p>Terimakasih.</p>
        </body>
        </html>
        ";
        
        $mail->Body = $mailBody;
        
        if (!$mail->send()) {
            $error = "Mailer Error: " . $mail->ErrorInfo;
            // echo json_encode($error); 
        }
        else {
            // echo json_encode("Email terkirim");
        }
    }
}