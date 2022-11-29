
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .navbar{
    background-color: rgb(0, 0, 50);
    color: white;
    height: auto;
    width: 100%;
    padding-left: 60px;
    padding-right: 60px;
    display: block;
}
header img{
    float:left
}

.navbar-nav1{
    flex-direction: row;
}

.btn{
    color: white;
}

.btn:hover{
    color: white;
    border-bottom: 2px solid white;    
}

.btn1{
    border: 2px solid white;
}

.btn1:hover{
    color:black;
    background-color: white;
}

@media screen and (max-width:700px){
    .navbar .container-fluid{
       flex-direction: column;
    }
}
@media screen and (max-width:525px){
    .container-fluid div a{
        float: none;
        width: 100%;
    }
}
.footer-dark {
  padding:50px 0;
  color:#f0f9ff;
  background-color:#282d32;
}

.footer-dark h3 {
  margin-top:0;
  margin-bottom:12px;
  font-weight:bold;
  font-size:16px;
}

.footer-dark ul {
  padding:0;
  list-style:none;
  line-height:1.6;
  font-size:14px;
  margin-bottom:0;
}

.footer-dark ul a {
  color:inherit;
  text-decoration:none;
  opacity:0.6;
}

.footer-dark ul a:hover {
  opacity:0.8;
}

@media (max-width:767px) {
  .footer-dark .item:not(.social) {
    text-align:center;
    padding-bottom:20px;
  }
}

.footer-dark .item.text {
  margin-bottom:36px;
}

@media (max-width:767px) {
  .footer-dark .item.text {
    margin-bottom:0;
  }
}

.footer-dark .item.text p {
  opacity:0.6;
  margin-bottom:0;
}

.footer-dark .item.social {
  text-align:center;
}

@media (max-width:991px) {
  .footer-dark .item.social {
    text-align:center;
    margin-top:20px;
  }
}

.footer-dark .item.social > a {
  font-size:20px;
  width:36px;
  height:36px;
  line-height:36px;
}

  </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div>
                    <form action="{{url('/')}}/searching" method="GET" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="text-center">
                           <h3>Wellcome {{session('name')}}</h3>
               </div>
                <div class="nav navbar-nav1">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong"><a href="#" class="notification">
                   <span class="badge">{{$notification}}</span></a>Inbox</button>&nbsp;&nbsp;
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                           <a href="#" class="btn"></a>Friends list</button> &nbsp;&nbsp;
                    <a href="{{ url('/logout')}}" class="btn btn-danger">logout</a>&nbsp;&nbsp;
                </div>
            </div>
        </nav>
    </header>
<br>
<br>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Friends request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @foreach($req as $item) 
      <br>
      <br> 
    <div class="col-6mx-auto">
            <div class="card shadow border">
                <div class="card-body d-flex flex-column align-items-center">
                   <h4 class="card-title">{{$item->name}}</h4>
                    <p class="card-text">New friend sugestion</p>
                    <a href="{{ url('/confirme')}}/{{$item->id}}" class="btn btn-primary">confirme request</a>
                    <br>
                    <a href="{{ url('/reject')}}/{{$item->id}}" class="btn btn-danger">reject request</a>
                </div>
            </div>
        </div>
     @endforeach 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Friends list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($frnd_list as $item) 
        <br>
      <br> 
    <div class="col-3xmx-auto">
            <div class="card shadow border">
                <div class="card-body d-flex flex-column align-items-center">
                   <h4 class="card-title">{{$item->name}}</h4>
                    <p class="card-text">now you both friend</p>
                </div>
            </div>
        </div>
         @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
   @endif
     @foreach($users as $item)  
    <div class="col-3 mx-auto">
            <div class="card shadow border">
                <div class="card-body d-flex flex-column align-items-center">
                   <h4 class="card-title">{{$item->name}}</h4>
                    <p class="card-text">New friend sugestion</p>
                    <a href="{{ url('/friends')}}/{{$item->id}}" class="btn btn-primary">add friend</a>
                </div>
            </div>
        </div>
     @endforeach 
    </div>
</div>


<br>
<br>
<!-- foooter -->

<div class="footer-dark">
        <footer>
            <div class="container">
            </div>
        </footer>
    </div>
</body>
</html>
