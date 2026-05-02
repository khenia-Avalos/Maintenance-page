import { c as createComponent, $ as $$Layout, a as $$Header } from './Header_u2Kcgok6.mjs';
import 'piccolore';
import { r as renderComponent, a as renderTemplate, m as maybeRenderHead, b as addAttribute } from './prerender_CZsszPLm.mjs';
import { $ as $$Button } from './button_DBs0C677.mjs';

const services = [{"id":1,"title":"Lawn Care","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet.","features":["","","","",""],"image":"/images/lawn.jpg"},{"id":2,"title":"Cleaning Services","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet.","features":["","","","",""],"image":"/images/cleaning.jpg"},{"id":3,"title":"Snow Removal","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet.","features":["","","","",""],"image":"/images/snow.jpg"},{"id":4,"title":"Power Washing","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet.","features":["","","","",""],"image":"/images/pow.jpg"}];
const servicesData = {
  services,
};

const $$Services = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Cleaning and Maintenance Services ", "description": "Discover our comprehensive cleaning and maintenance services. From power washing to lawn care, we keep your property pristine year-round. Contact us for a free quote!" }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Header", $$Header, {})}  ${maybeRenderHead()}<section class="pt-32 pb-16 bg-gradient-to-br from-white via-[#FAF0E6] to-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="text-center"> <span class="text-[#6B7280] font-semibold text-sm uppercase tracking-wide">What We Offer</span> <h1 class="text-4xl md:text-6xl font-bold text-[#1A1A1A] mt-2">Our Services</h1> <div class="w-20 h-0.5 bg-[#D2B48C] mx-auto mt-4 mb-6"></div> <p class="text-xl text-[#4B5563] max-w-3xl mx-auto">
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
</p> </div> </div> </section>  <section class="py-16 bg-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> ${servicesData.services.map((service, index) => renderTemplate`<div${addAttribute(`flex flex-col ${index % 2 === 0 ? "md:flex-row" : "md:flex-row-reverse"} gap-12 items-center mb-20 last:mb-0`, "class")}> <!-- Imagen --> <div class="flex-1"> <img${addAttribute(service.image, "src")}${addAttribute(service.title, "alt")} class="rounded-2xl shadow-xl w-full h-96 object-cover"> </div> <!-- Texto --> <div class="flex-1"> <h2 class="text-3xl md:text-4xl font-bold text-[#1A1A1A] mb-4">${service.title}</h2> <p class="text-lg text-[#4B5563] mb-6 leading-relaxed"> ${service.description} </p> <div class="mb-6"> <h3 class="font-semibold text-[#1A1A1A] mb-3">Includes:</h3> <ul class="grid grid-cols-2 gap-2"> ${service.features.map((feature) => renderTemplate`<li class="flex items-center gap-2 text-[#4B5563]"> <svg class="w-4 h-4 text-[#D2B48C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path> </svg> ${feature} </li>`)} </ul> </div> </div> </div>`)} </div> </section>  <section class="py-16 bg-white"> <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8"> <h2 class="text-3xl md:text-4xl font-bold text-[#1A1A1A] mb-4">Ready to get started?</h2> <p class="text-[#4B5563] mb-8">Contact us today for a free estimate</p> ${renderComponent($$result2, "Button", $$Button, { "href": "/contact", "text": "Get Free Estimate" })} </div> </section> ` })}`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/pages/Services.astro", void 0);

const $$file = "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/pages/Services.astro";
const $$url = "/Services";

const _page = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Services,
  file: $$file,
  url: $$url
}, Symbol.toStringTag, { value: 'Module' }));

const page = () => _page;

export { page };
