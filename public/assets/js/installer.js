document.addEventListener("alpine:init", () => {
  Alpine.data("installer", () => ({
    form: "database",

    data: {
      db: {
        host: "",
        user: "",
        pass: "",
        name: "",
      },
    },
  }));
});
