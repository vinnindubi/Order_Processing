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
              <span class="badge bg-danger ms-1 postHere">0</span>
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
    const updateIcon= document.querySelector('.postHere');
    cartItem.addEventListener('click',function(){
     cartBox.classList.add('active');
    });
    closeButton.addEventListener('click',function(){
     cartBox.classList.remove('active');
    });

    const addToCart=document.querySelectorAll('#addToCartBtn');
    let items=[];
    addToCart.forEach((cartItem)=>{
      const card= cartItem.closest('.card');
      const productId=card.querySelector('.product-id').innerText;
      const h1Value=card.querySelector('.card-needed').innerText;
      const cardDesc=card.querySelector('.card-text').innerText;
      const productPrice=card.querySelector('.productPrice').innerText;
      cartItem.addEventListener('click',()=>{
        if(typeof(Storage)!== 'undefined'){
        let item={
          id: productId,
          name: h1Value,
          description: cardDesc,
          price: productPrice,
          number:1
        }
        if(JSON.parse(localStorage.getItem('localDemo')) === null){
          items.push(item);
            localStorage.setItem('localDemo',JSON.stringify(items));
            window.location.reload();
        }else{
           const response=JSON.parse(localStorage.getItem('localDemo'));
           response.forEach(data=>{
            if(item.id == data.id){
              item.number = data.number +1;
            } else {
              items.push(data); // <-- pushes the existing product from storage
            }
           });
           items.push(item); //adds the new item clicked to the array.
           localStorage.setItem('localDemo',JSON.stringify(items));
           window.location.reload();
        }        
    }
    else
     {
      alert('local Storage is not working');
    }
      });
      
    });
    //adding data to shopping cart
    let no=0;
      JSON.parse(localStorage.getItem('localDemo')).map(data=>{
          no = no+data.number;
      });
      updateIcon.textContent = no;
   });
</script>

