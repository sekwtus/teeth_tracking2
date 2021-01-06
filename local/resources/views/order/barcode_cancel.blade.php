

<div class="col-1 p-0 text-left">
    <button type="button" class="btn btn-danger" onclick="barcode_cancel()">ยกเลิก Order</button>
</div>

<script>
    function barcode_cancel(){
        if ( confirm('ต้องการยกเลิกบาร์โค้ดหรือไม่ ?') ) {
            window.location =  '{{  url('/order')  }}';
        }
    }
</script>