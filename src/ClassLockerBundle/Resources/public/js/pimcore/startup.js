pimcore.registerNS("pimcore.plugin.DivanteClassLockerBundle");

pimcore.plugin.DivanteClassLockerBundle = Class.create(pimcore.plugin.admin, {
    getClassName: function () {
        return "pimcore.plugin.DivanteClassLockerBundle";
    },

    initialize: function () {
        pimcore.plugin.broker.registerPlugin(this);
    },

    pimcoreReady: function (params, broker) {
        //alert("DivanteClassLockerBundle ready!");
    }
});

var DivanteClassLockerBundlePlugin = new pimcore.plugin.DivanteClassLockerBundle();
Ext.define('overrides.pimcore.object.classes.klass',{
    override:'pimcore.object.classes.klass',
    saveOnComplete: function (response) {

        try {
            var res = Ext.decode(response.responseText);
            if(res.success) {
                // refresh all class stores
                this.parentPanel.tree.getStore().load();
                pimcore.globalmanager.get("object_types_store").load();
                pimcore.globalmanager.get("object_types_store_create").load();

                // set the current modification date, to detect modifcations on the class which are not made here
                this.data.modificationDate = res['class'].modificationDate;

                pimcore.helpers.showNotification(t("success"), t("class_saved_successfully"), "success");
            } else {
                throw res.message;
            }
        } catch (e) {
            this.saveOnError(e);
        }

    },

    saveOnError: function (e) {
        pimcore.helpers.showNotification(t("error"), t(e), "error");
    }
});