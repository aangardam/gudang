<?php

?>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    
    <div>
      <p class="app-sidebar__user-name">{{Auth::user()->name }}</p>
      <p class="app-sidebar__user-designation">{{Auth::user()->email }}</p>
    </div>
  </div>
  <ul class="app-menu">
    <li>
      <a class="app-menu__item" href="{{ url('home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
    </li>
    @if(Auth::user()->hasRole('Admin'))
      <li>
        <a class="app-menu__item" href="{{ url('Kategori')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Kategori</span></a>
      </li>
      <li>
        <a class="app-menu__item" href="{{ url('Toko')}}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Toko</span></a>
      </li>
      <li>
        <a class="app-menu__item" href="{{ url('Vendors')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Vendors</span></a>
      </li>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Produk</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="app-menu__item" href="{{ url('Produk/PO')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">PO</span></a></li>
            <li><a class="app-menu__item" href="{{ url('Produk/Stok')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Stok Gudang</span></a></li>
            <li><a class="app-menu__item" href="{{ url('Produk/store')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Stok Toko</span></a></li>
            <li><a class="app-menu__item" href="{{ url('Produk/return')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Return</span></a></li>
        </ul>
      </li>
      <li>
        <a class="app-menu__item" href="{{ url('User')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a>
      </li>
    @elseif (Auth::user()->hasRole('Kepala Toko'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Produk</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
          <li><a class="app-menu__item" href="{{ url('Produk/pending')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Pending</span></a></li>
          <li><a class="app-menu__item" href="{{ url('Produk/approve')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Gudang</span></a></li>
          <li><a class="app-menu__item" href=""><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Return</span></a></li>
      </ul>
    </li>
    @elseif(Auth::user()->hasRole('Vendor'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Produk</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
          <li><a class="app-menu__item" href="{{ url('Produk/inprogres')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">In Progres</span></a></li>
          <li><a class="app-menu__item" href="{{ url('Produk/finished')}}"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Selesai</span></a></li>
      </ul>
    </li>
    @else
    <li>
      <a class="app-menu__item" href="{{ url('User')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a>
    </li>
    @endif
  </ul>
</aside>