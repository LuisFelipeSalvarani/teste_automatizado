(function () {
  const fecharMsg = document.querySelector(".menssagem .icon");
  const msg = document.querySelector(".menssagem");

  fecharMsg.addEventListener("click", () => {
    msg.classList.add("hidden");
  });

  setTimeout(() => msg.classList.add("hidden"), 3000);
})();