app.component("anmeldung", {
    templateUrl: "components/anmeldung.php",
    controller: "AnmeldungController"
});

app.controller("AnmeldungController", function($http){
    this.status = "You did not submit anything yet.";

    this.submit = () => {
        let parameter = JSON.stringify({teamsportart:this.teamsportart, einzelsportart:this.einzelsportart});
        let  url = "http://10.14.28.142/AjaxVanillaJS/register.php";

        $http({
            method: 'POST',
            url: url,
            data: parameter
        }).then(
            (response) => {
            console.log(response);
        this.status = response.data.infotext;
    },function (error){
            console.log(error);
        });
    }
});