import { motion, useInView } from "framer-motion";
import { useRef } from "react";
import eq1 from "@/assets/equipment-1.jpg";
import eq2 from "@/assets/equipment-2.jpg";
import eq3 from "@/assets/equipment-3.jpg";

const equipment = [
  { name: "Екскаватор", price: "2 500", image: eq1 },
  { name: "Автокран", price: "3 200", image: eq2 },
  { name: "Бульдозер", price: "2 800", image: eq3 },
];

const EquipmentSection = () => {
  const ref = useRef(null);
  const inView = useInView(ref, { once: true, margin: "-100px" });

  return (
    <section id="equipment" className="py-24 md:py-36 border-t border-border">
      <div className="container mx-auto px-6 md:px-12" ref={ref}>
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 1 }}
          className="mb-20"
        >
          <p className="text-primary text-[11px] tracking-[0.5em] uppercase">Спецтехніка</p>
        </motion.div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-10">
          {equipment.map((item, i) => (
            <motion.div
              key={item.name}
              initial={{ opacity: 0, y: 30 }}
              animate={inView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.8, delay: i * 0.2 }}
              className="group"
            >
              <div className="overflow-hidden mb-8">
                <img
                  src={item.image}
                  alt={item.name}
                  loading="lazy"
                  width={800}
                  height={600}
                  className="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]"
                />
              </div>
              <div className="flex items-baseline justify-between mb-3">
                <h3 className="text-foreground text-base font-medium tracking-wide">{item.name}</h3>
                <span className="text-muted-foreground text-sm">{item.price} грн/год</span>
              </div>
              <a
                href="#contact"
                className="text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300"
              >
                Оренда
              </a>
            </motion.div>
          ))}
        </div>

        <motion.div
          initial={{ opacity: 0 }}
          animate={inView ? { opacity: 1 } : {}}
          transition={{ duration: 1, delay: 0.8 }}
          className="mt-20"
        >
          <a
            href="#"
            className="text-muted-foreground text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-500"
          >
            Дивитися більше →
          </a>
        </motion.div>
      </div>
    </section>
  );
};

export default EquipmentSection;
