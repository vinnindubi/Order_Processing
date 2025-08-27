<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ti ti-bell"></i>
            <div class="notification bg-primary rounded-circle"></div>
          </a>
          <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
            <div class="message-body">
              <a href="javascript:void(0)" class="dropdown-item">
                Item 1
              </a>
              <a href="javascript:void(0)" class="dropdown-item">
                Item 2
              </a>
            </div>
          </div>
        </li>
        
      </ul>
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <li class="nav-item rounded-lg" >
            
            <i class="iconShopping btn btn-sm btn-outline-success mt-2" type="button"  href="">Cart
              <i class="ti ti-shopping-cart"></i>
              <span class="" >0</span>
            </i>
          </li>
           
          <li class="nav-item dropdown">
            <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="{{asset("./assets/images/profile/user-1.jpg")}}" alt="" width="35" height="35" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <div class="message-body">
                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">My Profile</p>
                </a>
                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-mail fs-6"></i>
                  <p class="mb-0 fs-3">My Account</p>
                </a>
                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-list-check fs-6"></i>
                  <p class="mb-0 fs-3">My Task</p>
                </a>
                <a href="" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>


<script>
  
  document.addEventListener('DOMContentLoaded',()=>{
    const cartItem = document.querySelector('.iconShopping');
    const closeButton = document.querySelector('.btn-close');
    const cartBox= document.querySelector('.cartBox');
    cartItem.addEventListener('click',function(){
     cartBox.classList.add('active');
    });
    closeButton.addEventListener('click',function(){
     cartBox.classList.remove('active');
    });
    if(typeof(Storage)!== 'undefined')
    {
      //  const object={
      //   name: "Vincent Ndereba",
      //   age: "21",
      //   items:{
      //     product:"sugar",
      //     price:300,
      //     quantity:2
      //   }
      //  };
      // localStorage.setItem("localStorageDemo",JSON.stringify(object));  
      const data=localStorage.getItem('localStorageDemo'); 
      
      console.log(JSON.parse(data));   
    }
    else
     {
      console.log('local Storage is not working')
    }
  });
</script>

