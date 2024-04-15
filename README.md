# Sale website with Alepay payment method

```
https://www.nganluong.vn/vn/home.html
```

<p align="center">
  <img src="demo/introduction.jpg" width=800><br/>
  <img src="demo/introduction_2.jpg" width=800><br/><br/><br/>
</p>

## Introduction
Using ```docker-compose up --build``` to up this project onto your Docker.
Then open PHP image terminal to run ```php yii migrate``` to create table in your database.
<p align="center">
  <img src="demo/yii migrate.jpg" width=800><br/><br/><br/>
</p>

## Login to phpmyadmin to control your data server
<p align="center">
  <img src="demo/phpmyadmin.jpg" width=800><br/><br/><br/>
</p>

## Sign up account
<p align="center">
  <img src="demo/signup.jpg" width=800><br/><br/><br/>
</p>

## Confirm email
<p align="center">
  Log in with your signed up account, then click on 'Tài khoản' to edit your account info.<br/>
  Add email that has been registered in Nganluong.vn<br/>
  <img src="demo/email.jpg" width=800><br/>
  -------------------------------------<br/>
  Open /app/runtime/mail in Docker Desktop.<br/>
  <img src="demo/email link.jpg" width=800><br/>
  -------------------------------------<br/>
  Enter confirm link onto browser.<br/>
  <img src="demo/paste link.jpg" width=800><br/>
  You will see this in your account <img src="demo/mail confirmed.jpg" width=800><br/>
</p>

## Push merchant's product on ```localhost:21080```
<p align="center">
  Click on 'Tạo sản phẩm mới' to push new product,<br/>
  <img src="demo/product.jpg" width=800><br/>
  -------------------------------------<br/>
  Upload product's image.<br/>
  <img src="demo/create_product.jpg" width=800><br/>
  -------------------------------------<br/>
  Edit your product.<br/>
  <img src="demo/edit_product.jpg" width=800><br/>
  <img src="demo/view_product.jpg" width=800><br/>
  <img src="demo/list_product.jpg" width=800><br/><br/><br/>
</p>

## Customer purchase product on ```localhost:20080```
<p align="center">
  Click on 'Thêm vào giỏ hàng' to add product to cart.<br/>
  <img src="demo/list_product_frontend.jpg" width=800><br/>
  -------------------------------------<br/>
  Click on 'Thanh toán' to purchase.<br/>
  <img src="demo/cart.jpg" width=800><br/>
  -------------------------------------<br/>
  Enter customer's information.<br/>
  <img src="demo/confirm_order.jpg" width=400><br/>
  <img src="demo/confirm_order_2.jpg" width=400><br/>
  <img src="demo/payment.jpg" width=800><br/><br/><br/>
</p>

## Bonus: Promethus and Grafana
<p align="center">
  <img src="demo/prometheus.jpg" width=800><br/>
  -------------------------------------<br/>
  <img src="demo/grafana.jpg" width=800><br/>
</p>

