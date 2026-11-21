/**
 * Jason Lantier Website - Interactive Client-Side Scripts
 */

document.addEventListener('DOMContentLoaded', function () {
  // Mobile Menu Toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const navLinks = document.getElementById('navLinks');

  function setNavOpen(isOpen) {
    navLinks.classList.toggle('open', isOpen);
    mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    mobileToggle.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
    const icon = mobileToggle.querySelector('i');
    if (icon) {
      icon.classList.toggle('fa-bars', !isOpen);
      icon.classList.toggle('fa-times', isOpen);
    }
  }

  if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', function (event) {
      event.stopPropagation();
      setNavOpen(!navLinks.classList.contains('open'));
    });

    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (window.innerWidth <= 1120) {
          setNavOpen(false);
        }
      });
    });

    document.addEventListener('click', function (event) {
      if (!navLinks.classList.contains('open')) return;
      if (!navLinks.contains(event.target) && !mobileToggle.contains(event.target)) {
        setNavOpen(false);
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && navLinks.classList.contains('open')) {
        setNavOpen(false);
        mobileToggle.focus();
      }
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > 1120 && navLinks.classList.contains('open')) {
        setNavOpen(false);
      }
    });
  }

  // Auto-dismiss alert messages after 7 seconds
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(function (alert) {
    setTimeout(function () {
      alert.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      alert.style.opacity = '0';
      alert.style.transform = 'translateY(-10px)';
      setTimeout(function () {
        alert.remove();
      }, 600);
    }, 7000);
  });

  // Client-side quick validation for Contact Form
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      const name = document.getElementById('formName');
      const email = document.getElementById('formEmail');
      const message = document.getElementById('formMessage');

      if (!name.value.trim() || !email.value.trim() || !message.value.trim()) {
        e.preventDefault();
        alert('Please fill out all required fields: Name, Email, and Message.');
      }
    });
  }

  // ==========================================================================
  // Blog slider: two front cards centered with left & right peek
  // ==========================================================================
  const blogViewport = document.getElementById('blogSliderViewport');
  const blogTrack = document.getElementById('blogSliderTrack');
  const blogPrevBtn = document.getElementById('blogSliderPrev');
  const blogNextBtn = document.getElementById('blogSliderNext');

  if (blogViewport && blogTrack && blogPrevBtn && blogNextBtn) {
    const realCards = Array.from(blogTrack.children);
    const totalRealCards = realCards.length;

    if (totalRealCards > 0) {
      const firstClone = realCards.map(function (card) {
        return card.cloneNode(true);
      });
      const lastClone = realCards.map(function (card) {
        return card.cloneNode(true);
      });

      blogTrack.prepend.apply(blogTrack, lastClone);
      blogTrack.append.apply(blogTrack, firstClone);

      let blogIndex = totalRealCards;
      let autoPlayTimer = null;
      let isHovering = false;
      let dragStartX = 0;
      let dragStartY = 0;
      let dragDeltaX = 0;
      let isPointerDown = false;
      let isDragging = false;
      let hasMovedSignificantly = false;
      let preventClick = false;
      let activePointerId = null;
      let isAnimating = false;

      function isDesktopMode() {
        return window.innerWidth > 640;
      }

      function updateActiveCard(index) {
        const allCards = Array.from(blogTrack.children);
        const twoInFront = isDesktopMode();
        const activeIndices = twoInFront ? [index, index + 1] : [index];

        allCards.forEach(function (card, i) {
          if (activeIndices.indexOf(i) !== -1) {
            card.classList.add('is-active', 'active');
            card.setAttribute('aria-hidden', 'false');
          } else {
            card.classList.remove('is-active', 'active');
            card.setAttribute('aria-hidden', 'true');
          }
        });
      }

      function calculateTargetX(index) {
        const allCards = blogTrack.children;
        const card1 = allCards[index];
        if (!card1) return 0;
        const viewportCenter = blogViewport.clientWidth / 2;

        if (!isDesktopMode()) {
          const cardCenter = card1.offsetLeft + card1.offsetWidth / 2;
          return viewportCenter - cardCenter;
        }

        const card2 = allCards[index + 1] || card1;
        const pairLeft = card1.offsetLeft;
        const pairRight = card2.offsetLeft + card2.offsetWidth;
        const pairCenter = (pairLeft + pairRight) / 2;
        return viewportCenter - pairCenter;
      }

      function setTrackPosition(index, transitionEnabled) {
        const targetX = calculateTargetX(index);
        blogTrack.style.transition = transitionEnabled
          ? 'transform 750ms cubic-bezier(0.16, 1, 0.3, 1)'
          : 'none';
        blogTrack.style.transform = 'translate3d(' + targetX + 'px, 0, 0)';
        updateActiveCard(index);
      }

      function nextSlide() {
        if (isAnimating) return;
        isAnimating = true;
        blogIndex += 1;
        setTrackPosition(blogIndex, true);

        setTimeout(function () {
          if (blogIndex >= 2 * totalRealCards) {
            blogIndex = totalRealCards;
            setTrackPosition(blogIndex, false);
          }
          isAnimating = false;
        }, 760);
      }

      function prevSlide() {
        if (isAnimating) return;
        isAnimating = true;
        blogIndex -= 1;
        setTrackPosition(blogIndex, true);

        setTimeout(function () {
          if (blogIndex < totalRealCards) {
            blogIndex = 2 * totalRealCards - 1;
            setTrackPosition(blogIndex, false);
          }
          isAnimating = false;
        }, 760);
      }

      function startAutoPlay() {
        stopAutoPlay();
        autoPlayTimer = setInterval(function () {
          if (!isHovering && !isDragging && !isAnimating) {
            nextSlide();
          }
        }, 4000);
      }

      function stopAutoPlay() {
        if (autoPlayTimer) {
          clearInterval(autoPlayTimer);
          autoPlayTimer = null;
        }
      }

      blogPrevBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        prevSlide();
        stopAutoPlay();
        startAutoPlay();
      });

      blogNextBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        nextSlide();
        stopAutoPlay();
        startAutoPlay();
      });

      // Clicking on a peeking side card advances to it, but never block links/buttons
      blogTrack.addEventListener('click', function (e) {
        // If clicking a link, button, or any interactive element, always let it navigate!
        if (e.target.closest('a, button')) {
          return;
        }

        const card = e.target.closest('.blog-slide-card');
        if (!card) return;
        const allCards = Array.from(blogTrack.children);
        const clickedIndex = allCards.indexOf(card);
        if (clickedIndex === -1) return;

        const twoInFront = isDesktopMode();
        const isFrontCard = twoInFront
          ? (clickedIndex === blogIndex || clickedIndex === blogIndex + 1)
          : (clickedIndex === blogIndex);

        if (isFrontCard) return;

        if (clickedIndex <= blogIndex - 1) {
          e.preventDefault();
          prevSlide();
          stopAutoPlay();
          startAutoPlay();
        } else if (clickedIndex >= (twoInFront ? blogIndex + 2 : blogIndex + 1)) {
          e.preventDefault();
          nextSlide();
          stopAutoPlay();
          startAutoPlay();
        }
      });

      // Suppress accidental click right after a drag/swipe gesture
      blogViewport.addEventListener('click', function (e) {
        if (preventClick || hasMovedSignificantly) {
          e.preventDefault();
          e.stopPropagation();
          preventClick = false;
          hasMovedSignificantly = false;
        }
      }, true);

      blogViewport.addEventListener('mouseenter', function () {
        isHovering = true;
        stopAutoPlay();
      });

      blogViewport.addEventListener('mouseleave', function () {
        isHovering = false;
        startAutoPlay();
      });

      blogViewport.addEventListener('pointerdown', function (event) {
        if (event.pointerType === 'mouse' && event.button !== 0) return;
        isPointerDown = true;
        isDragging = false;
        hasMovedSignificantly = false;
        preventClick = false;
        activePointerId = event.pointerId;
        dragStartX = event.clientX;
        dragStartY = event.clientY;
        dragDeltaX = 0;
        stopAutoPlay();
      });

      blogViewport.addEventListener('pointermove', function (event) {
        if (!isPointerDown) return;
        const diffX = event.clientX - dragStartX;
        const diffY = event.clientY - dragStartY;

        // If not dragging yet, only start dragging once horizontal movement threshold (> 8px) is crossed
        if (!isDragging) {
          if (Math.abs(diffX) > 8 && Math.abs(diffX) > Math.abs(diffY)) {
            isDragging = true;
            hasMovedSignificantly = true;
            preventClick = true;
            blogViewport.classList.add('is-dragging');
            blogViewport.style.cursor = 'grabbing';
            try {
              blogViewport.setPointerCapture(event.pointerId);
            } catch (err) {}
          } else {
            return;
          }
        }

        dragDeltaX = diffX;
        const baseTargetX = calculateTargetX(blogIndex);
        blogTrack.style.transition = 'none';
        blogTrack.style.transform = 'translate3d(' + (baseTargetX + dragDeltaX) + 'px, 0, 0)';
      });

      blogViewport.addEventListener('pointerup', function (event) {
        if (!isPointerDown) return;

        if (isDragging) {
          if (Math.abs(dragDeltaX) > 40) {
            if (dragDeltaX < 0) {
              nextSlide();
            } else {
              prevSlide();
            }
          } else {
            setTrackPosition(blogIndex, true);
          }
        }

        if (activePointerId !== null) {
          try {
            if (blogViewport.hasPointerCapture(activePointerId)) {
              blogViewport.releasePointerCapture(activePointerId);
            }
          } catch (err) {}
        }

        isPointerDown = false;
        isDragging = false;
        dragDeltaX = 0;
        activePointerId = null;
        blogViewport.style.cursor = '';
        blogViewport.classList.remove('is-dragging');

        if (hasMovedSignificantly) {
          setTimeout(function () {
            preventClick = false;
            hasMovedSignificantly = false;
          }, 80);
        } else {
          preventClick = false;
          hasMovedSignificantly = false;
        }

        if (!isHovering) {
          startAutoPlay();
        }
      });

      blogViewport.addEventListener('pointercancel', function (event) {
        if (activePointerId !== null) {
          try {
            if (blogViewport.hasPointerCapture(activePointerId)) {
              blogViewport.releasePointerCapture(activePointerId);
            }
          } catch (err) {}
        }
        isPointerDown = false;
        isDragging = false;
        hasMovedSignificantly = false;
        preventClick = false;
        dragDeltaX = 0;
        activePointerId = null;
        blogViewport.style.cursor = '';
        blogViewport.classList.remove('is-dragging');
        setTrackPosition(blogIndex, true);
        if (!isHovering) {
          startAutoPlay();
        }
      });

      window.addEventListener('resize', function () {
        setTrackPosition(blogIndex, false);
      });

      setTrackPosition(blogIndex, false);
      requestAnimationFrame(function () {
        setTrackPosition(blogIndex, false);
      });
      window.addEventListener('load', function () {
        setTrackPosition(blogIndex, false);
      });
      startAutoPlay();
    }
  }

  // ==========================================================================
  // Responsive 3D Horizontal Slider with Smooth Mouse Drag & Touchpad Sliding
  // ==========================================================================
  const viewport = document.getElementById('orgSliderViewport');
  const track = document.getElementById('orgSliderTrack');
  const prevBtn = document.getElementById('orgSliderPrev');
  const nextBtn = document.getElementById('orgSliderNext');
  const dotsContainer = document.getElementById('orgSliderDots');
  const currentCounter = document.getElementById('orgSliderCurrent');
  const totalCounter = document.getElementById('orgSliderTotal');

  if (viewport && track) {
    const cards = Array.from(track.querySelectorAll('.org-slider-card'));
    const totalCards = cards.length;
    let currentIndex = 0;
    let autoPlayTimer = null;

    // Pointer Drag Tracking
    let isPointerDown = false;
    let isDragging = false;
    let hasMoved = false;
    let startX = 0;
    let startY = 0;
    let scrollStart = 0;
    let pointerHistory = [];

    if (totalCounter) {
      totalCounter.textContent = String(totalCards).padStart(2, '0');
    }

    function normalizeIndex(index) {
      return (index + totalCards) % totalCards;
    }

    // Scroll smoothly to a specific card index with infinite loop behavior
    function scrollToIndex(index) {
      const wrappedIndex = normalizeIndex(index);
      const targetCard = cards[wrappedIndex];
      if (!targetCard) return;

      const viewportCenter = viewport.clientWidth / 2;
      const cardCenter = targetCard.offsetLeft + targetCard.offsetWidth / 2;
      const targetScroll = cardCenter - viewportCenter;

      viewport.style.scrollBehavior = 'smooth';
      viewport.scrollTo({
        left: targetScroll,
        behavior: 'smooth'
      });

      currentIndex = wrappedIndex;
      updateCards3D(wrappedIndex);
    }

    // Snap smoothly to whichever card is currently closest to the center
    function scrollToClosestCard() {
      const viewportCenter = viewport.scrollLeft + viewport.clientWidth / 2;
      let closestIndex = 0;
      let minDistance = Infinity;

      cards.forEach((card, idx) => {
        const cardCenter = card.offsetLeft + card.offsetWidth / 2;
        const distance = Math.abs(cardCenter - viewportCenter);
        if (distance < minDistance) {
          minDistance = distance;
          closestIndex = idx;
        }
      });

      if (closestIndex === 0) {
        viewport.scrollTo({ left: 0, behavior: 'smooth' });
      } else if (closestIndex === totalCards - 1) {
        viewport.scrollTo({ left: viewport.scrollWidth - viewport.clientWidth, behavior: 'smooth' });
      } else {
        scrollToIndex(closestIndex);
      }

      currentIndex = closestIndex;
      updateCards3D(closestIndex);
    }

    // Update 3D perspective transforms & indicators
    function updateCards3D(forcedIndex = null) {
      const viewportCenter = viewport.scrollLeft + viewport.clientWidth / 2;
      let closestIndex = 0;
      let minDistance = Infinity;

      cards.forEach((card, idx) => {
        const cardCenter = card.offsetLeft + card.offsetWidth / 2;
        const distance = cardCenter - viewportCenter;
        const absDist = Math.abs(distance);
        const isEdgeCard = idx === 0 || idx === cards.length - 1;

        if (absDist < minDistance) {
          minDistance = absDist;
          closestIndex = idx;
        }

        // Apply 3D perspective rotation on desktop/tablets
        if (window.innerWidth > 768) {
          if (isEdgeCard) {
            card.style.transform = 'scale(1) rotateY(0deg) translateZ(0px)';
          } else {
            const normalized = Math.max(-1, Math.min(1, distance / (card.offsetWidth * 1.15)));
            const rotateY = normalized * 7.5; // 3D angle
            const scale = 1 - Math.min(0.08, (absDist / (viewport.clientWidth * 1.4)) * 0.1);
            const translateZ = -Math.min(32, (absDist / 22));

            if (absDist < 50) {
              card.style.transform = 'scale(1) rotateY(0deg) translateZ(25px)';
            } else {
              card.style.transform = `scale(${scale.toFixed(3)}) rotateY(${rotateY.toFixed(2)}deg) translateZ(${translateZ.toFixed(1)}px)`;
            }
          }
        } else {
          card.style.transform = '';
        }
      });

      const activeIdx = forcedIndex !== null ? forcedIndex : closestIndex;
      currentIndex = activeIdx;

      // Update active classes
      cards.forEach((c, i) => {
        if (i === activeIdx) {
          c.classList.add('active');
        } else {
          c.classList.remove('active');
        }
      });

      // Update dots
      if (dotsContainer) {
        const dots = dotsContainer.querySelectorAll('.slider-dot');
        dots.forEach((dot, i) => {
          if (i === activeIdx) {
            dot.classList.add('active');
          } else {
            dot.classList.remove('active');
          }
        });
      }

      // Update counter
      if (currentCounter) {
        currentCounter.textContent = String(activeIdx + 1).padStart(2, '0');
      }
    }

    // ==========================================================================
    // Mouse / Touchpad Hold & Slide (Smooth Drag with Momentum)
    // ==========================================================================
    viewport.addEventListener('pointerdown', function (e) {
      if (e.target.closest('#orgSliderPrev') || e.target.closest('#orgSliderNext') || e.target.closest('.slider-dot')) return;
      if (e.target.closest('a')) {
        hasMoved = false;
        return;
      }
      if (e.button !== undefined && e.button !== 0) return; // Only primary click

      isPointerDown = true;
      isDragging = false;
      hasMoved = false;
      startX = e.clientX;
      startY = e.clientY;
      scrollStart = viewport.scrollLeft;
      pointerHistory = [{ time: performance.now(), x: e.clientX }];

      stopAutoPlay();
    });

    window.addEventListener('pointermove', function (e) {
      if (!isPointerDown) return;

      const dx = e.clientX - startX;
      const dy = e.clientY - startY;

      if (!isDragging && Math.abs(dx) > 8 && Math.abs(dx) > Math.abs(dy)) {
        isDragging = true;
        hasMoved = true;
        viewport.classList.add('is-dragging');
        viewport.style.scrollSnapType = 'none';
        viewport.style.scrollBehavior = 'auto';
        try {
          viewport.setPointerCapture(e.pointerId);
        } catch (err) { }
      }

      if (isDragging) {
        e.preventDefault();
        viewport.scrollLeft = scrollStart - dx;

        // Keep last 140ms history for inertia/momentum velocity calculation
        const now = performance.now();
        pointerHistory.push({ time: now, x: e.clientX });
        while (pointerHistory.length > 1 && now - pointerHistory[0].time > 140) {
          pointerHistory.shift();
        }

        // Live 3D update as you slide
        updateCards3D();
      }
    });

    function handlePointerUp(e) {
      hasMoved = false;
      if (!isPointerDown) return;
      isPointerDown = false;

      if (isDragging) {
        isDragging = false;
        viewport.classList.remove('is-dragging');
        try {
          viewport.releasePointerCapture(e.pointerId);
        } catch (err) { }

        // Calculate velocity (pixels/ms)
        let velocity = 0;
        if (pointerHistory.length >= 2) {
          const first = pointerHistory[0];
          const last = pointerHistory[pointerHistory.length - 1];
          const dt = last.time - first.time;
          if (dt > 10) {
            velocity = (last.x - first.x) / dt;
          }
        }

        // Re-enable smooth scroll & snap
        viewport.style.scrollSnapType = '';
        viewport.style.scrollBehavior = '';

        // If swiped with velocity, glide into the next or previous card
        if (Math.abs(velocity) > 0.3) {
          if (velocity < 0) {
            scrollToIndex(currentIndex + 1);
          } else {
            scrollToIndex(currentIndex - 1);
          }
        } else {
          // Otherwise snap cleanly to the closest card
          scrollToClosestCard();
        }

        resetAutoPlay();
      }
    }

    window.addEventListener('pointerup', handlePointerUp);
    window.addEventListener('pointercancel', handlePointerUp);

    // Prevent accidental click triggers on links/buttons when dragging
    viewport.addEventListener('click', function (e) {
      if (hasMoved) {
        e.preventDefault();
        e.stopPropagation();
        hasMoved = false;
        return;
      }

      if (e.target.closest('a')) {
        hasMoved = false;
      }
    }, true);

    // A vertical wheel or trackpad gesture scrolls the page. Sideways
    // gestures still move the cards through the viewport's own overflow.
    viewport.addEventListener('wheel', function (e) {
      const absX = Math.abs(e.deltaX);
      const absY = Math.abs(e.deltaY);

      if (absY <= absX || absY < 1) return;

      e.preventDefault();
      const lineHeight = parseFloat(getComputedStyle(document.documentElement).fontSize) * 1.6 || 16;
      const delta = e.deltaMode === 1 ? e.deltaY * lineHeight : e.deltaMode === 2 ? e.deltaY * window.innerHeight : e.deltaY;
      window.scrollBy(0, delta);
    }, { passive: false });

    // ==========================================================================
    // Navigation Buttons & Indicators
    // ==========================================================================
    if (prevBtn) {
      prevBtn.addEventListener('click', function () {
        scrollToIndex(currentIndex - 1);
        resetAutoPlay();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function () {
        scrollToIndex(currentIndex + 1);
        resetAutoPlay();
      });
    }

    if (dotsContainer) {
      dotsContainer.addEventListener('click', function (e) {
        const dot = e.target.closest('.slider-dot');
        if (dot && dot.dataset.index !== undefined) {
          const idx = parseInt(dot.dataset.index, 10);
          scrollToIndex(idx);
          resetAutoPlay();
        }
      });
    }

    // Scroll listener fallback for smooth 3D update
    let scrollTimeout = null;
    viewport.addEventListener('scroll', function () {
      if (!isDragging) {
        if (scrollTimeout) {
          cancelAnimationFrame(scrollTimeout);
        }
        scrollTimeout = requestAnimationFrame(() => {
          updateCards3D();
        });
      }
    }, { passive: true });

    // Keyboard navigation (Left / Right arrow keys)
    window.addEventListener('keydown', function (e) {
      if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') return;
      const rect = viewport.getBoundingClientRect();
      const isInView = rect.top < window.innerHeight && rect.bottom > 0;
      if (isInView) {
        if (e.key === 'ArrowLeft') {
          e.preventDefault();
          scrollToIndex(currentIndex - 1);
          resetAutoPlay();
        } else if (e.key === 'ArrowRight') {
          e.preventDefault();
          scrollToIndex(currentIndex + 1);
          resetAutoPlay();
        }
      }
    });

    // Auto Play (every 6.5s, pauses on hover/drag)
    function startAutoPlay() {
      stopAutoPlay();
      autoPlayTimer = setInterval(function () {
        const nextIndex = (currentIndex + 1) % totalCards;
        scrollToIndex(nextIndex);
      }, 6500);
    }

    function stopAutoPlay() {
      if (autoPlayTimer) {
        clearInterval(autoPlayTimer);
        autoPlayTimer = null;
      }
    }

    function resetAutoPlay() {
      stopAutoPlay();
      startAutoPlay();
    }

    viewport.addEventListener('mouseenter', stopAutoPlay);
    viewport.addEventListener('mouseleave', function () {
      if (!isDragging) startAutoPlay();
    });

    // Initial setup
    setTimeout(function () {
      scrollToIndex(0);
      startAutoPlay();
    }, 150);

    // Window resize handler
    window.addEventListener('resize', function () {
      updateCards3D();
    });
  }
});


/* ==========================================================================
   Hero Portrait Crossfade
   Smoothly fades between jason-hero-1.png and jason-hero-2.png every 4s
   ========================================================================== */
(function () {
  'use strict';

  function initHeroCrossfade() {
    var portraits = document.querySelectorAll('.hero-portrait');
    if (!portraits || portraits.length < 2) return;

    var circle = document.querySelector('.hero-portrait-circle');
    var themeColors = ['#052069', '#c59b27', '#03133d', '#e5b94c', '#0d389e', '#a07d1a'];
    var currentIndex = 0;
    var colorIndex = 0;

    // Only keep the static intro image when a single hero portrait remains.

    function crossfadeTo(nextIndex) {
      portraits[nextIndex].classList.add('active');
      portraits[currentIndex].classList.remove('active');
      currentIndex = nextIndex;
    }

    setInterval(function () {
      crossfadeTo((currentIndex + 1) % portraits.length);
    }, 3200);

    if (circle) {
      setInterval(function () {
        colorIndex = (colorIndex + 1) % themeColors.length;
        circle.style.backgroundColor = themeColors[colorIndex];
        circle.classList.toggle('is-wide', colorIndex % 2 === 0);
      }, 2200);
    }
  }

  // Run after DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroCrossfade);
  } else {
    initHeroCrossfade();
  }
})();
