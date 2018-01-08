<?php 

$con=mysqli_connect('localhost','root','','seriousdating');

$query_total_revenue=mysqli_query($con,"select sum(subscr_price) as Total_Revenue from subscription");

$total_revenue = mysqli_fetch_object($query_total_revenue);