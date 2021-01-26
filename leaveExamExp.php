<?php

$time = date('d-m-Y H:i:m');
$stu_id = '1';
    $exam = array(
        "$stu_id" => array( 
                            
                        array(
                                'que_id'      =>   '1',
                            ),
                        array(
                                'que_id'      =>   '2',
                            ),
                        array(
                                'que_id'      =>   '3',
                        ),    
                        
                ),
        'leave'    =>   "$time",        
        'expire'   =>   date( 'd-m-Y H:i:m', time() + 600),
    );

    $leave_quetions = json_encode($exam);
    setcookie('leave_quetions' , $leave_quetions , time() + 60000);

    // echo '<pre>';
    if(isset($_COOKIE['leave_quetions']))
    {   
        $arr = $_COOKIE['leave_quetions'];
        print_r($arr);
    }
    echo '<br><br>';


    if(isset($_COOKIE['leave_quetions']))
    {   
        $cookie_data = stripslashes($_COOKIE['leave_quetions']);
        $quetions    = json_decode($cookie_data , true);
        print_r($quetions);
        echo '<br><br>';
        echo "Leave time " . $quetions['leave'] . '<br>';
        
        // $end_time = $quetions['expire'];
        $end_time = '22-09-2020 15:38:00';
        echo "End time : $end_time <br>";
        // $quetions['leave']  = '21-09-2020 16:07:03';
        // $end_time           = '21-09-2020 16:17:00';
        if($quetions['leave'] < $end_time)
        {
            $remaining  = strtotime($end_time) - strtotime($quetions['leave']);
            $hour = floor(($remaining/60) / 60);
            $min  = floor(($remaining/60) % 60);  
            $arr = explode(':',$quetions['leave']);
            $arrSec = $arr[2];
            if($arrSec == '00')
            {
                $arrSec = '60';
            }
            $sec = (60 - $arrSec);

            echo "hrs : " . $hour;
            echo "<br> min : " . $min;
            echo "<br> sec: " . $sec;
            
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <p id="quiz-time-left"> Time Left : <span id="hourZero"></span><span id="hour"></span> : 
                                            <span id="minZero"></span><span id="min"></span> : 
                                            <span id="secZero"></span><span id="sec"></span></p>
</body>
<script>

    let hour = "<?php if(isset($hour)) { echo $hour; }  else { echo "1" ;} ?>";
    let min  = "<?php if(isset($min))  { echo $min;  }  else { echo "0" ;} ?>";
    let sec  = "<?php if(isset($sec))  { echo $sec;  }  else { echo "0" ;} ?>";

    startCoundDown(hour , min , sec);
    function startCoundDown(hour , min , sec)
    {
        document.getElementById("hour").innerText  = hour;
        document.getElementById("min").innerText  = min;
        document.getElementById("sec").innerText  = sec;

        var timeInterval = setInterval(() => {
            sec  = document.getElementById("sec").innerText;
            min  = document.getElementById("min").innerText;
            hour = document.getElementById("hour").innerText;
            result = checkTimeUp(hour ,min , sec );
            if(result)
            {
                setHour(hour, min, sec)
                setMinutes(hour , min , sec );
                setSecond(sec);
                
            }
            else{
                // console.log('Times UP');
                // alert('Times up');
                window.location = './unsetCookie.php';
                clearInterval(timeInterval);
            }
        }, 1000);
    }

    

    function checkTimeUp(hour , min , sec)
    {
        if(hour == '0' && min == '0' && sec == '0'){
            return false;
        }
        return true;
    }

    function setHour(hour , min , sec)
    {
        if(hour != '0' && min == '0' && sec == '0')
        {
            hour = hour - 1;
            document.getElementById("hour").textContent  = hour;
        }
        else
        {
            document.getElementById("hour").textContent  = hour;
        }

        if(hour < 10)
        {
            document.getElementById('hourZero').textContent = '0';
        }
        else
        {
            document.getElementById('hourZero').textContent = '';
        }
    }

    function setMinutes(hour , min , sec)
    {
        let minZero = document.getElementById('minZero');
        let seconds = document.getElementById("min");
        if(min != '0' && sec == '0')
        {
            min = min - 1;
            
        }
        else if(hour != '0' && min == '0' && sec != '0')
        {
            min = '0';
        }
        else if(hour != '0' && min == '0' && sec == '0')
        {
            min = '59';
        }

        seconds.textContent  = min;

        if(min < 10)
        {
            minZero.textContent = '0';
        }
        else
        {
            minZero.textContent = '';
        }
    }

    function setSecond(sec)
    {
        
        if(sec != '0')
        {
            sec = sec - 1;
            document.getElementById("sec").textContent  = sec;
        }
        else
        {
            let sec = parseInt(59);
            document.getElementById("sec").textContent  = sec;
        }

        secZero = document.getElementById('secZero');
        sec = document.getElementById("sec").innerText;
        if(sec < 10)
        {
            secZero.textContent = '0';
        }
        else
        {
            secZero.textContent = '';
        }
    }
    
    
    
    

</script>
</html>