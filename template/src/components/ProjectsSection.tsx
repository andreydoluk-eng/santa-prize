import { motion, useInView } from "framer-motion";
import { useRef } from "react";
import p1 from "@/assets/project-1.jpg";
import p2 from "@/assets/project-2.jpg";
import p3 from "@/assets/project-3.jpg";

const projects = [
  { title: "Бізнес-центр, Київ", image: p1 },
  { title: "Автомагістраль М-30", image: p2 },
  { title: "Мостовий перехід", image: p3 },
];

const ProjectsSection = () => {
  const ref = useRef(null);
  const inView = useInView(ref, { once: true, margin: "-100px" });

  return (
    <section id="projects" className="py-24 md:py-36 border-t border-border">
      <div className="container mx-auto px-6 md:px-12" ref={ref}>
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 1 }}
          className="mb-20"
        >
          <p className="text-primary text-[11px] tracking-[0.5em] uppercase">Об'єкти</p>
        </motion.div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {projects.map((project, i) => (
            <motion.div
              key={project.title}
              initial={{ opacity: 0, y: 30 }}
              animate={inView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.8, delay: i * 0.2 }}
              className="group relative overflow-hidden"
            >
              <img
                src={project.image}
                alt={project.title}
                loading="lazy"
                width={800}
                height={600}
                className="w-full aspect-[3/2] object-cover transition-transform duration-700 group-hover:scale-[1.03]"
              />
              <div className="absolute inset-0 bg-background/30 group-hover:bg-background/10 transition-colors duration-500" />
              <div className="absolute bottom-0 left-0 p-6">
                <p className="text-foreground/80 text-xs tracking-[0.2em] uppercase">{project.title}</p>
              </div>
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

export default ProjectsSection;
