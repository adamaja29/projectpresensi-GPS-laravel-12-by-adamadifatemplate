<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="{{route('home')}}" class="item {{ request()->is('home') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>

    <a href="/presensi/izin" class="item">
        <div class="col">
            <ion-icon name="calendar-outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>

    </a>
    <a href="{{route('presensi')}}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
<a href="/presensi/histori" class="item">
    <div class="col">
    <ion-icon name="document-text-outline" role="img" class="my hydrated" aria-label="add outline"></ion-icon>
    <strong>History</strong>
        </div>
 </a>
    <a href="{{route('editprofile')}}" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->
