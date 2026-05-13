import { motion, useInView } from "framer-motion";
import { useRef, useState } from "react";

const ContactSection = () => {
  const ref = useRef(null);
  const inView = useInView(ref, { once: true, margin: "-100px" });
  const [form, setForm] = useState({ name: "", phone: "", message: "" });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
  };

  return (
    <section id="contact" className="py-24 md:py-36 border-t border-border">
      <div className="container mx-auto px-6 md:px-12" ref={ref}>
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-24 lg:gap-32">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={inView ? { opacity: 1, y: 0 } : {}}
            transition={{ duration: 1 }}
          >
            <p className="text-primary text-[11px] tracking-[0.5em] uppercase mb-10">Контакти</p>
            <h2 className="text-2xl md:text-4xl font-light text-foreground tracking-wide mb-16">
              Зв'яжіться з нами
            </h2>

            <div className="space-y-8">
              <div>
                <p className="text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-3">Телефон</p>
                <p className="text-foreground text-lg font-light">+380 (XX) XXX-XX-XX</p>
              </div>
              <div>
                <p className="text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-3">Email</p>
                <p className="text-foreground text-lg font-light">info@santa-prize.com</p>
              </div>
            </div>
          </motion.div>

          <motion.form
            initial={{ opacity: 0, y: 20 }}
            animate={inView ? { opacity: 1, y: 0 } : {}}
            transition={{ duration: 1, delay: 0.2 }}
            onSubmit={handleSubmit}
            className="space-y-10 pt-2"
          >
            <div>
              <label className="block text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-4">Ім'я</label>
              <input
                type="text"
                value={form.name}
                onChange={(e) => setForm({ ...form, name: e.target.value })}
                className="w-full bg-transparent border-b border-border text-foreground py-3 focus:outline-none focus:border-primary transition-colors duration-500 text-base font-light"
              />
            </div>
            <div>
              <label className="block text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-4">Телефон</label>
              <input
                type="tel"
                value={form.phone}
                onChange={(e) => setForm({ ...form, phone: e.target.value })}
                className="w-full bg-transparent border-b border-border text-foreground py-3 focus:outline-none focus:border-primary transition-colors duration-500 text-base font-light"
              />
            </div>
            <div>
              <label className="block text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-4">Повідомлення</label>
              <textarea
                value={form.message}
                onChange={(e) => setForm({ ...form, message: e.target.value })}
                rows={3}
                className="w-full bg-transparent border-b border-border text-foreground py-3 focus:outline-none focus:border-primary transition-colors duration-500 resize-none text-base font-light"
              />
            </div>
            <button
              type="submit"
              className="px-10 py-4 bg-foreground text-background text-[11px] tracking-[0.25em] uppercase hover:bg-primary hover:text-primary-foreground transition-all duration-500 mt-4"
            >
              Надіслати
            </button>
          </motion.form>
        </div>
      </div>
    </section>
  );
};

export default ContactSection;
