import { motion, useInView } from "framer-motion";
import { useRef } from "react";
import s1 from "@/assets/service-1.jpg";
import s2 from "@/assets/service-2.jpg";
import s3 from "@/assets/service-3.jpg";
import s4 from "@/assets/service-4.jpg";
import s5 from "@/assets/service-5.jpg";
import s6 from "@/assets/service-6.jpg";

const services = [
  { title: "Земляні роботи", num: "01", image: s1 },
  { title: "Демонтажні роботи", num: "02", image: s2 },
  { title: "Дорожнє будівництво", num: "03", image: s3 },
  { title: "Висотні роботи", num: "04", image: s4 },
  { title: "Енергетичні послуги", num: "05", image: s5 },
  { title: "Транспортні послуги", num: "06", image: s6 },
];

const ServicesSection = () => {
  const ref = useRef(null);
  const inView = useInView(ref, { once: true, margin: "-100px" });

  return (
    <section id="services" className="py-24 md:py-36 border-t border-border">
      <div className="container mx-auto px-6 md:px-12" ref={ref}>
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 1 }}
          className="max-w-2xl mb-20"
        >
          <p className="text-primary text-[11px] tracking-[0.5em] uppercase mb-10">Послуги</p>
          <p className="text-muted-foreground text-lg leading-relaxed">
            Надаємо професійні послуги в галузі енергетики, будівництва, виробництва та інших напрямках.
          </p>
        </motion.div>

        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          {services.map((service, i) => (
            <motion.div
              key={service.title}
              initial={{ opacity: 0, y: 20 }}
              animate={inView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.7, delay: 0.15 + i * 0.08 }}
              className="group relative overflow-hidden border border-border"
            >
              <img
                src={service.image}
                alt={service.title}
                loading="lazy"
                width={1024}
                height={768}
                className="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.04]"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-background/90 via-background/40 to-background/10 group-hover:from-background/95 transition-colors duration-500" />
              <div className="absolute inset-0 p-6 md:p-7 flex flex-col justify-between">
                <span className="text-foreground/60 text-xs tabular-nums tracking-[0.3em]">
                  {service.num}
                </span>
                <div className="flex flex-col gap-5">
                  <span className="text-foreground text-base md:text-lg font-light tracking-wide">
                    {service.title}
                  </span>
                  <a
                    href="#contact"
                    className="inline-flex items-center gap-2 self-start border-b border-foreground/30 pb-1 text-[10px] tracking-[0.4em] uppercase text-foreground/80 hover:text-primary hover:border-primary transition-colors duration-300"
                  >
                    Деталі
                    <span aria-hidden="true" className="text-foreground/50">→</span>
                  </a>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ServicesSection;
