class CustomAccordion extends HTMLElement {
    buttons = [];
    contents = [];

    constructor() {
        super();
    }

    connectedCallback() {
        this.buttons = Array.from(this.querySelectorAll(".accordion-header .accordion-btn"));
        this.contents = Array.from(this.querySelectorAll(".accordion-contenu .contenu"));

        this.buttons.forEach((button, index) => {
            button.addEventListener("click", () => this.showContent(index));
        });

        this.showContent(0);
    }

    showContent(index) {
        this.contents.forEach(content => content.classList.remove("active"));
        this.buttons.forEach(button => button.classList.remove("active"));

        this.contents[index].classList.add("active");
        this.buttons[index].classList.add("active");
    }
}

customElements.define("custom-accordion", CustomAccordion);
