import { motion, useInView } from "framer-motion";
import { useRef } from "react";

const AboutSection = () => {
  const ref = useRef(null);
  const inView = useInView(ref, { once: true, margin: "-100px" });

  return (
    <section id="about" className="py-24 md:py-36">
      <div className="container mx-auto px-6 md:px-12" ref={ref}>
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 1 }}
          className="max-w-2xl"
        >
          <p className="text-primary text-[11px] tracking-[0.5em] uppercase mb-10">Про компанію</p>
          <h2 className="text-2xl md:text-4xl font-light text-foreground leading-[1.4] tracking-wide">
            Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт — від земляних до висотних та дорожніх.
          </h2>
        </motion.div>
      </div>
    </section>
  );
};

export default AboutSection;
