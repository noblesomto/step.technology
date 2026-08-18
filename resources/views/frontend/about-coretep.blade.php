@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'About CORETEP'])

<section class="py-16">
    <div class="max-w-4xl mx-auto px-4 space-y-8">
        <h3 class="font-step-heading font-semibold text-xl text-step-primary">After exhaustive technical reviews, extensive discussions and deliberations around the reports from the stakeholders on the state of affairs of our technology and energy sectors, the council rose with the following observations, decisions and recommendations as its resolution:</h3>

        <ul class="space-y-3 text-gray-600">
            <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Technology and energy council examination should be conducted for registrable individuals or organizations only, by the use of the approved council examination module from CORETEP.</li>
            <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Every eligible individual must go through this council examination before he or she will be registered or licensed to practice as a technology or energy professional.</li>
            <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Every organization operating within the technology and energy value chain (i.e. renewable energy, oil and gas, technology organizations, energy organizations, companies etc.) should strengthen their workforce and country economy by ensuring full compliance with the council examination and procedures.</li>
            <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Government bodies, agencies and parastatals are enjoined to strengthen their workforce and country economy by facilitating this council examination in her system.</li>
            <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Individuals or organizations should always comply with the council code of conduct when practicing with a CORETEP license.</li>
        </ul>

        <div>
            <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-3">Exam Tracks</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <span><strong>Entry level</strong> &mdash; for university graduates with 0&ndash;10 years' experience who wish to practice in the technology and energy sectors.</span></li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <span><strong>Professionals</strong> &mdash; for professionals seeking to demonstrate their expertise.</span></li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <span><strong>Specialized</strong> &mdash; for individuals with advanced knowledge in a specific discipline in the tech and energy sectors (i.e. energy management, energy efficiency, solar energy, cyber security, software development etc.).</span></li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <span><strong>Expatriates</strong> &mdash; skilled and unskilled professionals from foreign countries who wish to practice in Nigeria's technology and energy sectors.</span></li>
            </ul>
        </div>

        <div>
            <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-3">Exemptions</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Technology and energy industry leaders with a proven track record of excellence and accountability in their organization (i.e. supervisors, team leaders, coordinators, superintendents, managers, senior managers, company executive officers, executive directors, chief executive officers, managing directors, company chairmen and board of directors).</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Professors and academics with a strong teaching and research background in a relevant field.</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Highly experienced professionals with 25 years of experience in a technology and energy discipline.</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> Registered engineers (COREN certified) with 30 years' practical experience in academia or industry.</li>
            </ul>
        </div>

        <div>
            <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-3">Exam Requirements</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Academic Qualifications</strong> &mdash; hold a recognized degree in a relevant field (e.g. energy, engineering, sciences, environmental science etc.).</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Professional Experience</strong> &mdash; have a minimum amount of relevant work experience.</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Training and Certifications</strong> &mdash; hold relevant certifications or trainings from a notable organization in technology and energy.</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Membership Requirements</strong> &mdash; meet the membership requirements of STEP (e.g. pay dues, agree to code of ethics).</li>
            </ul>
        </div>

        <div>
            <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-3">Guidelines for Exam Eligibility</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Application Review</strong> &mdash; the council will review each application to determine eligibility.</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Documentation Requirements</strong> &mdash; registrable individuals or applicants must provide supporting documents (e.g. transcripts, certificates, resumes).</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Eligibility Decision</strong> &mdash; the council will make a decision based on the application and supporting documentation.</li>
                <li class="flex items-start gap-2"><i class="fa fa-angle-right text-step-accent mt-1"></i> <strong>Appeals Process</strong> &mdash; the council shall establish an appeals process for applicants who disagree with the eligibility decision.</li>
            </ul>
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
