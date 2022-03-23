<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">BUS-Park</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Вопросы
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.index-page.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Кнопки на начальной</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.check-list.index')}}" >
                <i class="bi bi-check-square"></i>

                <span>Чек-листы</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.input.index')}}" >
                <i class="bi bi-input-cursor"></i>

                <span>Поля ввода</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.check-list-question.index')}}" >
                <i class="bi bi-patch-question"></i>

                <span>Вопросы чек листов</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Ответы
        </div>

        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.check-list-answered.index')}}" >
                <i class="bi bi-patch-question"></i>

                <span>Чек Листы</span>
            </a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.input-answered.index')}}" >
                <i class="bi bi-patch-question"></i>
                <span>Формы</span>
            </a>
        </li>

        <!-- Nav Item - Tables -->
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->


    </ul>
    <!-- End of Sidebar -->
</div>
