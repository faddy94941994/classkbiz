<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'kbank.php';
require_once 'kbiz.php';

$params['username'] = 'Imm1910Aim';
$params['password'] = 'Imm116010Aim*-';
$params['cookie_path'] 	= dirname(__FILE__). '/cookie.txt';
$account_number = '1303711577';
$start_date = '01/09/2023';
$end_date = '30/09/2023';

$kbank = new Kbank($params);
$result = $kbank->login();

if($result){
    echo 'Login ok.';
    echo "<br>";
    echo "==========================";
    echo "<br>";
    
    $res = $kbank->GetBalance($account_number);
    $balance = $res['data']['availableBalanceSum'];
 
    echo "Balance ". $balance;
    echo "<br>";
    echo "==========================";
    echo "<br>";
    
    $res = $kbank->getTransaction($account_number, $start_date, $end_date);
    
    
    print_r($res);
    exit;
    
    
    foreach($res['data']['recentTransactionList'] as $row){
        if($row['depositAmount'] != null){
            echo 'depositAmount: '. $row['depositAmount'];echo "<br>";
            echo 'transDate: '. $row['transDate'];echo "<br>";
            echo "==========================";
            echo "<br>";
        }
    }
    
    /*
    {
        "clientRefID": "20231002163202622854",
        "serviceRefID": "ACS20231002163202296305",
        "status": "S",
        "timestamp": "2023-10-02T16:32:02.471+07:00",
        "data": {
            "rowCount": 0,
            "totalList": 2,
            "navRefKey": "2023-09-26|12:42:45|001303711577000000000167|0740|2023-09-26-12.42.47.848578",
            "recentTransactionList": [
                {
                    "transDate": "2023-09-26 12:42:45",
                    "effectiveDate": "Tue Sep 26 07:00:00 ICT 2023",
                    "transNameTh": "ชำระด้วยบัตรเดบิต",
                    "transNameEn": "Debit Card Spending",
                    "depositAmount": null,
                    "withdrawAmount": 811.72,
                    "accountPartner": "label.bank.other.account",
                    "channelTh": "เครื่องรูดบัตร (EDC)/E-Commerce",
                    "channelEn": "EDC/E-Commerce",
                    "origRqUid": "268_20230926_762010339584460905326905563816",
                    "toAccountNumber": null,
                    "fromAccountNameEn": null,
                    "fromAccountNameTh": null,
                    "benefitAccountNameTh": "",
                    "benefitAccountNameEn": "",
                    "transType": "FTOB",
                    "originalSourceId": "268",
                    "transCode": "0740",
                    "debitCreditIndicator": "DR",
                    "proxyTypeCode": "",
                    "proxyId": "",
                    "proxyIdMasking": null
                },
                {
                    "transDate": "2023-09-26 12:41:25",
                    "effectiveDate": "Tue Sep 26 07:00:00 ICT 2023",
                    "transNameTh": "รับโอนเงิน",
                    "transNameEn": "Transfer Deposit",
                    "depositAmount": 1000.00,
                    "withdrawAmount": null,
                    "accountPartner": "label.bank.other.account",
                    "channelTh": "Internet/Mobile ต่างธนาคาร",
                    "channelEn": "Internet/Mobile Across Banks",
                    "origRqUid": "001_20230926_0148324FEE74EB4A3ED",
                    "toAccountNumber": null,
                    "fromAccountNameEn": null,
                    "fromAccountNameTh": null,
                    "benefitAccountNameTh": "",
                    "benefitAccountNameEn": "",
                    "transType": "FTOB",
                    "originalSourceId": "1",
                    "transCode": "0900",
                    "debitCreditIndicator": "CR",
                    "proxyTypeCode": "A",
                    "proxyId": "1303711577",
                    "proxyIdMasking": null
                }
            ]
        }
    }
    */
}else{
    echo 'Login fail.';
}
?>