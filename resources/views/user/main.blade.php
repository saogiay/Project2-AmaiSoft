
<!DOCTYPE html>
<html lang="en">
@include('user.layouts.head')
<body >
	{{-- class="animsition" --}}
	@include('user.layouts.navbar')
		@yield('content')

@include('user.layouts.footer')

@include('user.layouts.end')
</body>
</html>