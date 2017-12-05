<html>
<style>
.row
{
	max-width:1160px;
	margin:0 auto;
}

body
{
	font-family:impact fantasy;
}

.home
{
	position:absolute;
	width:1200px;
	top:20%;
	left:50%;
	transform:translate(-50%,-50%);
}

header
{
	background-image:url("home.jpg");
	height:100vh;
	background-position:center;
	background-size:cover;
}

h1
{
	color:black;
	font-size:50px;
}
.button {
    background-color: #4CAF50; 
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 200px 450px;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
}
.button1:hover {
    background-color: #4CAF50;
    color: white;
}
.button2 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
	margin: -180px 450px;
	padding: 16px 46px;
}
.button2:hover {
    background-color: #4CAF50;
    color: white;
}

</style>
<body>
<header>
<div class="row">
 <a href="register.php"><button class="button button1">Sign Up Customer</button></a>
 <a href="artist/register.php"><button class="button button2">Sign Up Artist</button></a>
</div>
<div class="home">
<h1> <center> Artist Booking System</center></h1>
</div>
</header>
</body>
</html>