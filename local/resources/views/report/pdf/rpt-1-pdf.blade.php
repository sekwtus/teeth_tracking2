<html>
<head><title>รายงาน 1</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('bootstrap-3.3.7/css/bootstrap.min.css') }}">
  <style>
    @page {
      margin: 1.5cm 1.5cm 1.5cm 1.5cm; /*t r b l*/
    }
    @font-face {
      font-family: 'THSarabunNew';
      font-style: normal;
      font-weight: normal;
      src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
    }
    @font-face {
      font-family: 'THSarabunNew';
      font-style: normal;
      font-weight: bold;
      src: url('{{ asset('fonts/THSarabunNew Bold.ttf') }}') format('truetype');
    }
    @font-face {
      font-family: 'THSarabunNew';
      font-style: italic;
      font-weight: normal;
      src: url('{{ asset('fonts/THSarabunNew Italic.ttf') }}') format('truetype');
    }
    @font-face {
      font-family: 'THSarabunNew';
      font-style: italic;
      font-weight: bold;
      src: url('{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}') format('truetype');
    }
    header,body,h1,h2,h3,h4,h5, .page-num{
      font-family: 'THSarabunNew';
      font-weight: bold;
      color: black;
    }
    .page-num:after{
      counter-increment: pages;
      content: counter(page) ' of ' counter(pages);
    }
    header {
      position: fixed;
      top: -1cm;
      left: 0cm;
      right: 0cm;
    }
    body {
      padding-top: 3.13cm;
    }
    footer {
      position: fixed;
      bottom: -1cm;
      left: 0cm;
      right: 0cm;
      height: 1cm;
    }
    table {
      width: 100%;
    }
    .tbl-logo td{ border:1px solid #fff; }
    .tbl-head th{ border: 1px solid #fff;
      padding-top:-10px;
    }
    .tbl-main th {
      padding-top: -5px;
      padding-bottom: 5px;
    }
    .tbl-main td{
      padding-top:-13px;
      padding-left:5px;
      padding-right:5px;
      font-weight: normal;
    }
    .tbl-main th, .tbl-main td{
      border: 1px solid #000;
      padding-left:5px;
      padding-right:5px;
    }
    .tbl-head, .tbl-main, .tbl-footer{
      font-size: 18px;
    }
    .img-logo > img{
      width:160px;
      height:55px;
    }
    .tbl-footer th {
      padding-bottom: -5px;
    }


    .doc td, .doc-total td {
      padding-top:-10px;
    }
    .doc td, .doc-total td, .bill-total td{
      font-weight: bolder;
    }
  </style>
</head>
<body>
  <header>
    <div class="row text-right" style="padding-top:-10px; padding-bottom:14px;">
      <b class="page-num" style="font-size:16px;"></b>
    </div>

    <div class="row" style="background:#80ff00x;">
      <div class="col-xs-12">
        <table class="tbl-logo">
          <tr>
            <td style="padding-top:3px;">
              <div class="img-logo text-center">
                <img src="{{asset('images/logo-dt.png')}}">
              </div>
              <div class="text-center">
                <h3 style="margin-top:-10px;">รายงาน.....</h3>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row" style="margin-top:-10px; background:yellowx;">
      <div class="col-xs-12">
        <table class="tbl-head">
          <tr>
            <th><b>วันที่จาก</b> 2019-01-01 <b>ถึง</b>2019-01-31</th>
            <th colspan="" class="text-right"><b>วันที่พิมพ์</b> 2019-01-29</th>
          </tr>
        </table>
      </div>
    </div>

  </header>

  <footer>
    <div class="row text-center" style="margin-top:15px; padding-top:-10px;">
      <b style="font-size:16px;">{{ 'footer' }}</b>
    </div>
  </footer>

  <main>
    <div class="row">
      <div class="col-xs-12">
        <table class="tbl-main">
          <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th>วันที่</th>
              <th>ชื่อคนไข้</th>
              <th class="text-right">ค่าบริการ</th>
              <th class="text-right">VAT</th>
              <th class="text-right">รวมทั้งสิ้น</th>
            </tr>
          </thead>
          <tbody>
            @for ($i=0; $i<40; $i++)
              <tr>
                <td class="text-center">{{$i+1}}</td>
                <td>2019-01-30</td>
                <td>ทดสอบ{{$i}}</td>
                <td class="text-right">{{$i}}</td>
                <td class="text-right">{{$i}}</td>
                <td class="text-right">{{$i}}</td>
              </tr>
            @endfor
            <tr>
              <td colspan="5" style="border:none;"></td>
              <td class="text-right" style="border:1px solid #000">{{$i*100}}</td>
            </tr>
          </tbody>
        </table>
        <br>
      </div>
    </div>
  </main>
</body>
</html>
