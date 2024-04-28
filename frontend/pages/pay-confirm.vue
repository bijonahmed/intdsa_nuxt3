<template>
    <title>Payment</title>
    <div>
        <!-- <Navbar /> -->

        <h1>
            <center>Payment successfully</center>
        </h1>

        <!-- <Footer /> -->
        <!-- <MobileFooter /> -->
    </div>
</template>

<script setup>

const closeMdal = () => {
    console.log("close modal");
    $(".address_mdla").fadeOut();
}

//setTimeout(closeMdal, 5000);
onMounted(() => {
    closeMdal();

});

</script>