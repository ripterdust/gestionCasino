<img src="" alt="" id="qrCode">
<script>
    var canvas = document.createElement( "canvas" );
    var ctx = canvas.getContext( "2d" );
    const qr = {!! json_encode($qr) !!}
    const img = document.createElement('img')
    img.setAttribute( "src", "data:image/svg+xml;base64," + qr );
    img.onload = function() {
        ctx.drawImage( img, 0, 0 );
        
        // Now is done
        console.log( canvas.toDataURL( "image/png" ) );
        const imgQr = document.querySelector('#qrCode')
        imgQr.setAttribute('src', canvas.toDataURL( "image/png" ))
    };
</script>