<img src="" alt="" id="qrCode">
<canvas id="myCanvas" width="300" height="300" style="display: none"></canvas>
<script>
    const tmn = 300
    var canvas1 = document.createElement("canvas");
    let canvas = document.querySelector('#myCanvas')
    var ctx = canvas.getContext( "2d" );
    const qr = {!! json_encode($qr) !!}
    const img = document.createElement('img')
    img.setAttribute( "src", "data:image/svg+xml;base64," + qr );
    img.onload = function() {
        ctx.drawImage(img, 0, 0, tmn, tmn);
        console.log(qr);
        // Now is done
        const imgQr = document.querySelector('#qrCode')
        imgQr.setAttribute('src', canvas.toDataURL( "image/jpeg", 1.0 ))
    };
</script>