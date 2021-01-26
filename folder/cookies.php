<?php
    // setcookie("leave_quetions", "", time() - 3600);

    if(isset($_COOKIE['leave_quetions']))
    {

        $attemted    = json_decode($_COOKIE['leave_quetions'] , true);
        echo  "Leave Time :"    . $attemted['leave'] . '<br>';
        echo  "Expire Time :"   . $attemted['expire'] . '<br>';
        $q_id = [];
        foreach($attemted as $que)
        {
            if(is_array($que))
            {
                foreach($que as $q_number)
                {
                    if(is_array($q_number))
                    {
                        foreach($q_number as $key => $val)
                        {
                            $q_id [] = $val;
                            echo $key .  ' = ' . $val . '<br>'; 

                        }
                    }
                }
            }
        }

        print_r($q_id);
    }
?>