import { motion } from "framer-motion";
import heroBg from "@/assets/hero-bg.jpg";

const HeroSection = () => {
  return (
    <section id="hero" className="relative h-screen flex items-end overflow-hidden pb-24 md:pb-32">
      {/* Background */}
      <div className="absolute inset-0">
        <img
          src={heroBg}
          alt="Будівельна техніка на об'єкті"
          width={1920}
          height={1080}
          className="w-full h-full object-cover"
        />
        <div className="absolute inset-0 bg-background/60" />
      </div>

      {/* Content */}
      <div className="relative z-10 container mx-auto px-6 md:px-12">
        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 1.2, delay: 0.2 }}
          className="text-primary text-[11px] tracking-[0.5em] uppercase mb-8"
        >
          Оренда спецтехніки та професійні послуги
        </motion.p>

        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 1.2, delay: 0.4 }}
          className="text-5xl md:text-7xl lg:text-[6.5rem] font-semibold tracking-[0.08em] text-foreground leading-none mb-10"
        >
          SANTA-PRIZE
        </motion.h1>

        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 1.2, delay: 0.8 }}
          className="text-muted-foreground text-base md:text-lg max-w-lg leading-relaxed mb-14"
        >
          Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт.
        </motion.p>

        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 1.2, delay: 1 }}
          className="flex items-center gap-6"
        >
          <a
            href="#equipment"
            className="px-10 py-4 bg-foreground text-background text-[11px] tracking-[0.25em] uppercase hover:bg-primary hover:text-primary-foreground transition-all duration-500"
          >
            Оренда техніки
          </a>
          <a
            href="#contact"
            className="text-muted-foreground text-[11px] tracking-[0.25em] uppercase hover:text-foreground transition-colors duration-500"
          >
            Зв'язатися →
          </a>
        </motion.div>
      </div>
    </section>
  );
};

export default HeroSection;
