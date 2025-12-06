<?php
// ================= LOAD FAQ DATA =================
$current_page = 'faq';

$faq_file  = __DIR__ . '/faqs/all-faqs.php';    // path adjust karo agar file aur jagah ho
$page_faqs = [];

if (file_exists($faq_file)) {
    $all_faqs  = include $faq_file;
    $page_faqs = $all_faqs[$current_page] ?? [];
}
?>

<?php if (!empty($page_faqs)): ?>
<section class="faq py-120">
    <div class="container">
        <!-- Section heading start -->
        <div class="max-w-780-px text-center mx-auto tw-mb-10"
             data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <span class="bg-main-50 text-main-600 fw-medium tw-text-base rounded-pill tw-px-5 tw-py-1 tw-mb-6">
                Our FAQs
            </span>
            <h2 class="splitTextStyleOne cursor-big">
                Frequently Asked Questions
                <span class="font-playfair fw-normal font-playfair fst-italic">About Us</span>
            </h2>
        </div>
        <!-- Section heading end -->

        <div class="row gy-4">
            <!-- LEFT COLUMN -->
            <div class="col-lg-6">
                <div class="accordion common-accordion d-flex flex-column tw-gap-5" id="accordionExampleLeft">
                    <?php
                    // half left, half right
                    $total     = count($page_faqs);
                    $half      = (int) ceil($total / 2);
                    $left_faqs = array_slice($page_faqs, 0, $half);

                    foreach ($left_faqs as $index => $faq):
                        // EXACT same classes as static, sirf ID dynamic
                        $is_open = ($index === 0);                 // first open
                        $id      = 'collapseLeft' . $index;        // e.g. collapseLeft0
                    ?>
                    <div class="accordion-item tw-py-3 tw-px-8 tw-rounded-xl bg-transparent mb-0 border border-neutral-200"
                         data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                        <h5 class="accordion-header d-flex align-items-center justify-content-between tw-gap-3">
                            <button
                                class="accordion-button shadow-none p-0 line-clamp-3 bg-transparent text-22-px fw-semibold <?= $is_open ? '' : 'collapsed' ?>"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?= $id ?>"
                                aria-expanded="<?= $is_open ? 'true' : 'false' ?>"
                                aria-controls="<?= $id ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                            </button>
                        </h5>
                        <div id="<?= $id ?>"
                             class="accordion-collapse collapse <?= $is_open ? 'show' : '' ?>"
                             data-bs-parent="#accordionExampleLeft">
                            <div class="accordion-body ps-0 pe-0 pb-0 tw-pt-5 max-w-620-px border-top border-neutral-200 tw-mt-5">
                                <p class="text-neutral-500 tw-leading-212">
                                    <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-6">
                <div class="accordion common-accordion d-flex flex-column tw-gap-5" id="accordionExampleRight">
                    <?php
                    $right_faqs = array_slice($page_faqs, $half);
                    foreach ($right_faqs as $index => $faq):
                        $id = 'collapseRight' . $index;           // e.g. collapseRight0
                    ?>
                    <div class="accordion-item tw-py-3 tw-px-8 tw-rounded-xl bg-transparent mb-0 border border-neutral-200"
                         data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                        <h5 class="accordion-header d-flex align-items-center justify-content-between tw-gap-3">
                            <button
                                class="accordion-button shadow-none p-0 line-clamp-3 bg-transparent text-22-px fw-semibold collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?= $id ?>"
                                aria-expanded="false"
                                aria-controls="<?= $id ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                            </button>
                        </h5>
                        <div id="<?= $id ?>"
                             class="accordion-collapse collapse"
                             data-bs-parent="#accordionExampleRight">
                            <div class="accordion-body ps-0 pe-0 pb-0 tw-pt-5 max-w-620-px border-top border-neutral-200 tw-mt-5">
                                <p class="text-neutral-500 tw-leading-212">
                                    <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
