import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;

Alpine.plugin(collapse);

Alpine.directive('countup', (el, { expression }, { evaluateLater }) => {
    const getTarget = evaluateLater(expression);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            observer.unobserve(el);

            getTarget((target) => {
                const targetValue = Number(target) || 0;
                const raw = el.dataset.countupRaw;
                const duration = 1800;
                const start = performance.now();

                const frame = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const value = Math.round(targetValue * eased);

                    el.textContent = raw === 'true'
                        ? String(value)
                        : value.toLocaleString('id-ID');

                    if (progress < 1) {
                        requestAnimationFrame(frame);
                    } else {
                        el.textContent = raw === 'true'
                            ? String(targetValue)
                            : targetValue.toLocaleString('id-ID');
                    }
                };

                requestAnimationFrame(frame);
            });
        });
    }, { threshold: 0.4 });

    observer.observe(el);
});

Alpine.start();