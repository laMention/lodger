<!DOCTYPE html>
<html>
<head>
  <title>{{config('app.name')}} - Code de vérification</title>
</head>
<body>

<style type="text/css" media="screen">
    .header{border-bottom: 1px solid #f3f4f6; padding-bottom: 25px; }
    .bodybloc{width: 600px;border: 1px solid #F3F4F6;margin: auto;text-align: center;padding: 30px;}
    body{font-family: 'Open Sans', sans-serif;">}
    .desboninfo{font-size: 14px; margin: 30px 0px; color: #646464;}
    .btndesa{background: #2dd7ff; padding: 8px 45px; border-radius: 35px; color: #fff; font-size: 15px; border: none; font-weight: 500; }
    
</style>

<div class="bodybloc">
  
    <div style="font-size: 14px;text-align: left;">Votre code de verification:</div> </br></br>
    <div>
        <center>
            <span style="font-weight:bolder;font-size: 19px;">{{$code_verification}}</span>
        </center>
    </div>

<div style=" font-size: 13px; margin-top: 40px; ">{{config('app.name')}} © {{date('Y')}}</div>
</div>
</body>
</html>
