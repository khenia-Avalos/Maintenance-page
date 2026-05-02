import { c as createComponent, r as renderScript, $ as $$Layout, a as $$Header } from './Header_u2Kcgok6.mjs';
import 'piccolore';
import { m as maybeRenderHead, a as renderTemplate, b as addAttribute, r as renderComponent } from './prerender_CZsszPLm.mjs';
import 'clsx';

const $$Hero = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<section id="home" class="pt-32 pb-20 bg-gradient-to-br from-white via-[#FAF0E6] to-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="grid md:grid-cols-2 gap-12 items-center"> <!-- Texto --> <div> <div class="inline-block mb-4"> <div class="w-12 h-0.5 bg-[#D2B48C]"></div> </div> <h1 class="text-5xl md:text-6xl font-bold text-[#1A1A1A] leading-tight mb-6">
Montero
<span class="text-[#6B7280]">Maintenance</span> <span class="text-sm block text-[#9CA3AF] font-normal mt-1">LLC</span> </h1> <p class="text-lg text-[#4B5563] mb-6 leading-relaxed">
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium dolor vero mollitia minus excepturi ipsa tenetur sapiente id omnis ad.
</p> </div> <!-- Imagen --> <div class="space-y-4"> <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600" alt="Property maintenance" class="rounded-2xl shadow-2xl w-full h-64 object-cover"> <div class="grid grid-cols-2 gap-4"> <img src="https://images.unsplash.com/photo-1596436889106-be35e843f974?w=300" alt="Lawn care" class="rounded-xl shadow-md w-full h-32 object-cover"> <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=300" alt="Cleaning" class="rounded-xl shadow-md w-full h-32 object-cover"> </div> </div> </div> </div> </section>`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/Hero.astro", void 0);

const features = [
	{
		title: "  Beneffits",
		description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, voluptate."
	},
	{
		title: "Beneffits",
		description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, voluptate."
	},
	{
		title: "Beneffits",
		description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, voluptate."
	}
];

const $$Features = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<h1 class="text-center font-bold text-5xl mt-10 text-[rgba(230,226,226,0.77)]">Why Choose Us</h1> <div class="grid md:grid-cols-3 gap-4 p-4"> ${features.map((feature) => renderTemplate`<div class="bg-[#FAF0E6] p-10 rounded-2xl mt-10 shadow-md hover:shadow-xl transition-shadow duration-300"> <h2 class="text-3xl font-bold text-[#1A1A1A] text-center">${feature.title}</h2> <p class="mt-4 text-[#4B5563]">${feature.description}</p> </div>`)} </div>`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/Features.astro", void 0);

const $$More = createComponent(($$result, $$props, $$slots) => {
  const services = [
    {
      icon: "/plant.svg",
      title: "Lawn Care",
      description: "lorem ipsum dolor sit amet consectetur adipisicing elit.",
      color: "bg-[#D8F5D8]",
      hoverColor: "hover:bg-[#C5E8C5]"
    },
    {
      icon: "/cleaning.svg",
      title: "Cleaning Services",
      description: "lorem ipsum dolor sit amet consectetur adipisicing elit.",
      color: "bg-[#FDE2E2]",
      hoverColor: "hover:bg-[#FAD0D0]"
    },
    {
      icon: "/snow.svg",
      title: "Snow Removal",
      description: "lorem ipsum dolor sit amet consectetur adipisicing elit.",
      color: "bg-[#E8E8E8]",
      hoverColor: "hover:bg-[#D8D8D8]"
    },
    {
      icon: "/street.svg",
      title: "Power Washing",
      description: "lorem ipsum dolor sit amet consectetur adipisicing elit.",
      color: "bg-[#D8EEF5]",
      hoverColor: "hover:bg-[#C5E2ED]"
    }
  ];
  return renderTemplate`${maybeRenderHead()}<section class="py-20 bg-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Encabezado --> <div class="text-center mb-12"> <span class="text-[#d35b28] font-semibold text-sm uppercase tracking-wide">What We Offer</span> <h2 class="text-4xl md:text-5xl font-bold text-[#1A1A1A] mt-2">Our Services</h2> <div class="w-20 h-0.5 bg-[#b8ac75] mx-auto mt-4"></div> <p class="text-[#4B5563] mt-4 max-w-2xl mx-auto">
Year-round property maintenance solutions tailored to your needs
</p> </div> <!-- Grid de servicios (4 columnas) --> <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6"> ${services.map((service) => renderTemplate`<div${addAttribute(`text-center p-6 rounded-2xl transition-all duration-300 hover:shadow-xl ${service.color} ${service.hoverColor}`, "class")}> <img${addAttribute(service.icon, "src")}${addAttribute(service.title, "alt")} class="w-16 h-16 mx-auto mb-4"> <h3 class="text-2xl font-bold text-[#1A1A1A] mb-3">${service.title}</h3> <p class="text-[#4B5563] leading-relaxed">${service.description}</p> <a href="#contact" class="inline-block mt-4 text-[#1A1A1A] font-semibold text-sm hover:text-[#D2B48C] transition-colors">
More
</a> </div>`)} </div> <!-- Botón CTA adicional --> <div class="text-center mt-12"> <a href="/contact" class="inline-block bg-[#1A1A1A] text-white px-8 py-3 rounded-lg hover:bg-[#333333] transition-colors font-semibold">
Get Free Estimate
</a> </div> </div> </section>`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/More.astro", void 0);

const $$Areas = createComponent(($$result, $$props, $$slots) => {
  const areas = [
    { city: "Margate" },
    { city: "Ventnor" },
    { city: "Longport" }
  ];
  return renderTemplate`${maybeRenderHead()}<section id="service-areas" class="py-20 bg-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Encabezado --> <div class="text-center mb-12"> <span class="text-[#6B7280] font-semibold text-sm uppercase tracking-wide">Coverage Map</span> <h2 class="text-4xl md:text-5xl font-bold text-[#1A1A1A] mt-2">Service Areas</h2> <div class="w-20 h-0.5 bg-[#D2B48C] mx-auto mt-4"></div> </div> <!-- Mapa de ubicación (estilo visual) --> <div class="relative bg-[#FAF0E6] rounded-3xl p-8 mb-10 overflow-hidden"> <div class="relative z-10 text-center"> <p class="text-[#6B7280] font-medium mb-2">Currently Operating in</p> <p class="text-3xl md:text-4xl font-bold text-[#1A1A1A]">Margate</p> </div> </div> <!-- Lista de ciudades (estilo tags/píldoras) --> <div class="flex flex-wrap justify-center gap-3"> ${areas.map((area) => renderTemplate`<div class="group"> <div class="bg-[#FAF0E6] hover:bg-[#D2B48C] px-5 py-2 rounded-full transition-all duration-300 cursor-default"> <span class="text-[#1A1A1A] group-hover:text-white font-medium text-sm"> ${area.city} </span> </div> </div>`)} </div> </div> </section>`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/Areas.astro", void 0);

const faqs = [{"question":"What areas do you serve?","answer":"lorem."},{"question":"Do you offer free estimates?","answer":"lorem."},{"question":"Are you licensed and insured?","answer":"lorem."},{"question":"How often should I schedule lawn care?","answer":"lorem"},{"question":"Do I need to be home during the service?","answer":"lorem."},{"question":"What happens if it rains on my scheduled day?","answer":"lorem"},{"question":"Do you use eco-friendly products?","answer":"lorem"},{"question":"How can I pay for services?","answer":"lorem"}];
const faqs$1 = {
  faqs,
};

const $$FAQ = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<section class="py-20 bg-white" data-astro-cid-4q2essmo> <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-astro-cid-4q2essmo> <!-- Encabezado --> <div class="text-center mb-12" data-astro-cid-4q2essmo> <span class="text-[#6B7280] font-semibold text-sm uppercase tracking-wide" data-astro-cid-4q2essmo>FAQ</span> <h2 class="text-4xl md:text-5xl font-bold text-[#1A1A1A] mt-2" data-astro-cid-4q2essmo>Frequently Asked Questions</h2> <div class="w-20 h-0.5 bg-[#D2B48C] mx-auto mt-4" data-astro-cid-4q2essmo></div> <p class="text-[#4B5563] mt-4 max-w-2xl mx-auto" data-astro-cid-4q2essmo>
Everything you need to know about our services
</p> </div> <!-- Grid de preguntas --> <div class="space-y-4" data-astro-cid-4q2essmo> ${faqs$1.map((faq, index) => renderTemplate`<div class="border border-gray-200 rounded-xl overflow-hidden bg-white hover:shadow-md transition-shadow duration-300" data-astro-cid-4q2essmo> <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center gap-4 bg-white hover:bg-[#FAF0E6] transition-colors duration-200"${addAttribute(index, "data-index")} data-astro-cid-4q2essmo> <span class="text-lg font-semibold text-[#1A1A1A]" data-astro-cid-4q2essmo>${faq.question}</span> <span class="faq-icon text-[#D2B48C] text-xl transition-transform duration-300" data-astro-cid-4q2essmo> <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-astro-cid-4q2essmo> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" data-astro-cid-4q2essmo></path> </svg> </span> </button> <div class="faq-answer hidden px-6 pb-4"${addAttribute(index, "data-index")} data-astro-cid-4q2essmo> <div class="pt-2 text-[#4B5563] leading-relaxed border-t border-gray-100" data-astro-cid-4q2essmo> ${faq.answer} </div> </div> </div>`)} </div> <!-- CTA final --> <div class="text-center mt-12 pt-8" data-astro-cid-4q2essmo> <p class="text-[#4B5563] mb-4" data-astro-cid-4q2essmo>Still have questions?</p> <a href="/contact" class="inline-block bg-[#1A1A1A] text-white px-8 py-3 rounded-lg hover:bg-[#333333] transition-colors font-semibold" data-astro-cid-4q2essmo>
Contact Us
</a> </div> </div> </section> ${renderScript($$result, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/FAQ.astro?astro&type=script&index=0&lang.ts")}`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/FAQ.astro", void 0);

const $$Index = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Professional Cleaning and Maintenance ", "description": "We offer professional residential and commercial cleaning services. Get a free quote. Personalized attention. Contact us today!" }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Header", $$Header, {})} ${renderComponent($$result2, "Hero", $$Hero, {})} ${renderComponent($$result2, "More", $$More, {})} ${renderComponent($$result2, "Features", $$Features, {})} ${renderComponent($$result2, "Areas", $$Areas, {})} ${renderComponent($$result2, "FAQ", $$FAQ, {})} ` })}`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/pages/index.astro", void 0);

const $$file = "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/pages/index.astro";
const $$url = "";

const _page = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Index,
  file: $$file,
  url: $$url
}, Symbol.toStringTag, { value: 'Module' }));

const page = () => _page;

export { page };
