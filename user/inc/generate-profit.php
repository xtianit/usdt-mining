<?php

$startTime = time();
// Check the last execution time
$lastExecutionQuery = "SELECT last_execution_time FROM last_execution WHERE id = 1";
$lastExecutionResult = mysqli_query($conn, $lastExecutionQuery);
$lastExecutionRow = mysqli_fetch_assoc($lastExecutionResult);
$lastExecutionTime = strtotime($lastExecutionRow['last_execution_time']);

// Check if 2 minutes have passed since the last execution
echo time();
if (time() - $lastExecutionTime >= 2 * 60) { // 2 minutes * 60 seconds/minute
    // Execute your code block
    executeCodeBlock();

    // Update the last execution time
    $updateQuery = "UPDATE last_execution SET last_execution_time = NOW() WHERE id = 1";
    mysqli_query($conn, $updateQuery);
}

// Sleep for 2 minutes before the next iteration




function executeCodeBlock()
{
    global $conn, $email;
    $userid = userid($email);
    //fetch plan
    $currentPlan = userPlan($userid);
    $currentPlanData = '$' . userPlan($userid);

    $investment = calculatePlan($currentPlanData, $currentPlan);
    $date = date("F j, Y, g:i a");
    //compute investment data
    //check email
    $checkEmail = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        //check investment data and plan
        $check_investment = mysqli_query($conn, "select * from account where userid='$userid'");
        if (mysqli_num_rows($check_investment) > 0) {
        }
    }

    $invUpdate = "update account set amount=(amount + ?) where userid =?";
    if ($stmt = mysqli_prepare($conn, $invUpdate)) {
        mysqli_stmt_bind_param($stmt, 'ds', $investment, $userid);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn)) {
            $insStats  = "INSERT INTO `investments` (`email`, `package`, `accrual`, `date`) VALUES (?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $insStats)) {
                mysqli_stmt_bind_param($stmt, 'ssds', $email, $currentPlanData, $investment, $date);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}
//fetch plan rate
function userPlan($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from account where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $plan = $row['plan'];
        return $plan;
    }
}

function userid($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email' limit 1");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $userid = $row['userid'];
        return $userid;
    }
}

function calculatePlan($planData, $plan)
{
    $accrual = '';
    switch ($planData) {
        case '$20':
            $accrual = $plan * 0.04;
            break;
        case '$50':
            $accrual = $plan * 0.05;
            break;
        case '$100':
            $accrual = $plan * 0.06;
            break;
        case '$300':
            $accrual = $plan * 0.06;
            break;
        case '$500':
            $accrual = $plan * 0.06;
            break;
        case '$1000':
            $accrual = $plan * 0.07;
            break;
        case '$3000':
            $accrual = $plan * 0.07;
            break;
        case '$5000':
            $accrual = $plan * 0.07;
            break;
        case '$10000':
            $accrual = $plan * 0.08;
            break;
        case '$30000':
            $accrual = $plan * 0.08;
            break;
    }
    return $accrual;
}
