
@if(session('success'))

<div class="alert alert-success alert-dismissible temp1" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <div class="alert-text">
        <h4><i class="bi bi-patch-check"></i> Mensaje del Sistema</h4>
        <ul><li>
            <span>{{session('success')}}</span>
        </li></ul>
    </div>
</div>
@endif

 @if (session('error'))
 <div class="alert alert-danger alert-dismissible temp1" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <div class="alert-text">
        <h4><i class="bi bi-patch-exclamation"></i> Mensaje del Sistema</h4>
        <ul><li>
            <span>{{session('error')}}</span>
        </li></ul>
    </div>
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning alert-dismissible temp1" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
   <div class="alert-text">
       <h4><i class="bi bi-patch-exclamation"></i> Mensaje del Sistema</h4>
       <ul><li>
        <span>{{session('warning')}}</span>
       </li></ul>
   </div>
</div>
@endif

@if(count($errors) > 0)
    <div class="errors alert alert-danger alert-dismissible temp1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <div class="alert-text">
            <h5><i class="bi bi-patch-exclamation" style="font-size: 2rem; margin-right: 10px;"></i> Mensaje del Sistema</h5>
            <ul>
                @foreach($errors->all() as $error)
                <li><span>{{ $error }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif


