<div>
    <p>Pais: {{$profile['country']}} </p>
    <p>Nombre: {{$profile['display_name']}} </p>
    <p>email: {{$profile['email']}} </p>
    <p>Dirección de Usuario: {{$profile['external_urls']['spotify']}} </p>
    <img src="{{$profile['images'][0]['url']}}" alt="profile">
</div>
