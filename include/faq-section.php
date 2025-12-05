<?php
// Auto-detect current page from URL or filename
$current_page = 'contact'; // Default
$request_uri = $_SERVER['REQUEST_URI'] ?? '';
$script_name = basename($_SERVER['SCRIPT_NAME'] ?? '');

// Map URLs/filenames to FAQ keys
$page_map = [
    '/contact-us.php' => 'contact',
    'contact-us.php' => 'contact',
    '/services.php' => 'services',
    'services.php' => 'services',
    '/about.php' => 'about',
    'about.php' => 'about',
    // Add more mappings
];

foreach ($page_map as $key => $faq_key) {
    if (strpos($request_uri, $key) !== false || $script_name === $key) {
        $current_page = $faq_key;
        break;
    }
}

// Load FAQs for current page
$page_faqs = [];
if (file_exists("include/all-faqs.php")) {
    $all_faqs = include "include/all-faqs.php";
    $page_faqs = $all_faqs[$current_page] ?? [];
}
?>

<?php if (!empty($page_faqs)): ?>
<section class="faq py-120">
    <div class="container">
        <!-- Section heading (customize per page if needed) -->
        <div class="max-w-780-px text-center mx-auto tw-mb-10" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <span class="bg-main-50 text-main-600 fw-medium tw-text-base rounded-pill tw-px-5 tw-py-1 tw-mb-6">Our FAQs</span>
            <h2 class="splitTextStyleOne cursor-big">Frequently Asked Questions <span class="font-playfair fw-normal font-playfair fst-italic">About <?= ucfirst($current_page) ?></span></h2>
        </div>
        
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="accordion common-accordion d-flex flex-column tw-gap-5" id="accordionExample">
                    <?php foreach (array_slice($page_faqs, 0, ceil(count($page_faqs)/2)) as $index => $faq): ?>
                    <div class="accordion-item tw-py-3 tw-px-8 tw-rounded-xl bg-transparent mb-0 border border-neutral-200" 
                         data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                        <h5 class="accordion-header d-flex align-items-center justify-content-between tw-gap-3">
                            <button class="accordion-button shadow-none p-0 line-clamp-3 bg-transparent text-22-px fw-semibold <?= $index === 0 ? '' : 'collapsed' ?>" 
                                    type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse<?= $index ?>" 
                                    <?= $index === 0 ? 'aria-expanded="true"' : 'aria-expanded="false"' ?> 
                                    aria-controls="collapse<?= $index ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                                <i class="ph-bold ph-caret-down ms-auto"></i>
                            </button>
                        </h5>
                        <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body ps-0 pe-0 pb-0 tw-pt-5 max-w-620-px border-top border-neutral-200 tw-mt-5">
                                <p class="text-neutral-500 tw-leading-212"><?= nl2br(htmlspecialchars($faq['answer'])) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if (count($page_faqs) > 4): ?>
                <div class="accordion common-accordion d-flex flex-column tw-gap-5" id="accordionExampleTwo">
                    <?php foreach (array_slice($page_faqs, ceil(count($page_faqs)/2)) as $index => $faq): ?>
                    <div class="accordion-item tw-py-3 tw-px-8 tw-rounded-xl bg-transparent mb-0 border border-neutral-200" 
                         data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                        <h5 class="accordion-header d-flex align-items-center justify-content-between tw-gap-3">
                            <button class="accordion-button shadow-none p-0 line-clamp-3 bg-transparent text-22-px fw-semibold collapsed" 
                                    type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseTwo<?= $index ?>" 
                                    aria-expanded="false" aria-controls="collapseTwo<?= $index ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                                <i class="ph-bold ph-caret-down ms-auto"></i>
                            </button>
                        </h5>
                        <div id="collapseTwo<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExampleTwo">
                            <div class="accordion-body ps-0 pe-0 pb-0 tw-pt-5 max-w-620-px border-top border-neutral-200 tw-mt-5">
                                <p class="text-neutral-500 tw-leading-212"><?= nl2br(htmlspecialchars($faq['answer'])) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
