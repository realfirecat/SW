app.component("radioButtonGroup", {
    templateUrl: "components/radio-button-group.html",
    controller: "radioButtonGroupController",
    bindings: {
        name: "@",
        rows: "<",
        class: "@"
    }
});

app.controller("radioButtonGroupController", function ($log) {
    $log.debug("test123");
    this.$onInit = function () {
        $log.debug(this.rows);
    };
});