<?php
    $langs = DB::table('blog_categories')->select('lang_key','name_cn')->get();
    $output = array();

    foreach ($langs as $lang)
    {
        $output[$lang->lang_key] = $lang->name_cn;
    }
    return $output;
     return [
    'register' => 'ລົງທະບຽນ',
    'province' => '省',
    'district' => '区',
    'village' => '村庄',
    'success' => '成功地',
    'thankyou' => '谢谢 !'
  ];
?>