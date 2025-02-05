$addr = explode(',',$email_addresses);

foreach ($addr as $ad) {
    $email->AddAddress( trim($ad) );       
}