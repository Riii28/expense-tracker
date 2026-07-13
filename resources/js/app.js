import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("transactionForm", ({ url, redirect }) => ({
    url,
    redirect,

    form: {
        amount: "",
        description: "",
        category: "",
        type: "",
    },

    loading: false,
    errors: {},
    message: "",
    success: false,

    async submit() {
        this.loading = true;
        this.errors = {};
        this.message = "";
        this.success = false;

        try {
            const response = await fetch(
                "http://localhost:8000/api/transactions",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                    body: JSON.stringify(this.form),
                },
            );

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422) {
                    this.errors = data.errors ?? {};
                }

                this.message = data.message ?? "Something went wrong.";
                return;
            }

            window.location.href = "/";
        } catch (error) {
            console.error(error);
            this.message = "Failed to connect to server.";
        } finally {
            this.loading = false;
        }
    },
}));

Alpine.start();
