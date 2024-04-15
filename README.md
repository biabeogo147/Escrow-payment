# Sale website with Alepay payment method

```
Register your account in https://www.nganluong.vn/vn/home.html to get merchant_id and merchant_password.
```

<p align="center">
  <img src="demo/introduction.jpg" width=800><br/>
  <img src="demo/introduction_2.jpg" width=800><br/><br/><br/>
</p>

## Introduction
Using ```docker-compose up --build``` to up this project onto your Docker.
Then open PHP image terminal to run ```php yii migrate``` to create table in your database.
<p align="center">
  <img src="demo/yii migrate.jpg" width=450><br/><br/><br/>
</p>

## Login to phpmyadmin to control your data server
<p align="center">
  <img src="demo/phpmyadmin.jpg" width=400><br/><br/><br/>
</p>

## Sign up account
<p align="center">
  <img src="demo/signup.jpg" width=600><br/><br/><br/>
</p>

## Confirm email
<p align="center">
  Log in with your signed up account, then click on 'Tài khoản' to edit your account info.<br/>
  Add email that has been registered in Nganluong.vn<br/>
  <img src="demo/email.jpg" width=600><br/>
  -------------------------------------<br/>
  Open /app/runtime/mail in Docker Desktop.<br/>
  <img src="demo/email link.jpg" width=600><br/>
  -------------------------------------<br/>
  Enter confirm link onto browser.<br/>
  <img src="demo/paste link.jpg" width=600><br/>
  You will see this in your account.<br/> 
  <img src="demo/mail confirmed.jpg" width=200><br/>
</p>

## Create Order
<p align="center">
  Click on 'Tạo đơn hàng mới' in 'Đơn hàng bán'.<br/>
  <img src="demo/merchant order.jpg" width=800><br/>
  -------------------------------------<br/>
  Enter your customer id + sale product.<br/>
  <img src="demo/merchant view.jpg" width=800><br/>
  -------------------------------------<br/>
  In customer view (another account).<br/>
  <img src="demo/cusomer view.jpg" width=800><br/>
  -------------------------------------<br/>
  Click on 'Accept request', then 'Chuyển tiền cho bên trung gian' and enter your merchant_id and password that have been registered in Nganluong.<br/>
  <img src="demo/nganluong id.jpg" width=800><br/>
  <img src="demo/cusomer view 2.jpg" width=800><br/>
  -------------------------------------<br/>
  In your account in nganluong.vn, you will see this:<br/>
  <img src="demo/paid status.jpg" width=800><br/><br/><br/>
</p>

