<?php

// ─── DOMAINS ────────────────────────────────────────────────────────────────

function bt_domains() {
    return [
        ['slug'=>'character-and-integrity',           'title'=>'Character & Integrity',            'description'=>'Build the ethical foundation, self-awareness, and authentic leadership presence that drives lasting trust and credibility.'],
        ['slug'=>'customer-and-results-orientation',  'title'=>'Customer & Results Orientation',   'description'=>'Master the strategies, mindsets, and customer-centric practices that transform experiences and drive measurable results.'],
        ['slug'=>'growth-and-change',                 'title'=>'Growth & Change',                  'description'=>'Navigate uncertainty, lead transformation, and build the organizational agility needed to thrive in an era of rapid change.'],
        ['slug'=>'people-and-culture',                'title'=>'People & Culture',                 'description'=>'Develop the leadership skills needed to build high-performing teams, strengthen culture, and lead through complexity.'],
        ['slug'=>'vision-and-strategy',               'title'=>'Vision & Strategy',                'description'=>'Sharpen your strategic thinking, lead with foresight, and align your organization around a compelling vision for the future.'],
    ];
}

function bt_domain($slug) {
    foreach (bt_domains() as $d) { if ($d['slug'] === $slug) return $d; }
    return null;
}

// ─── HELPER: HEADSHOT URL ────────────────────────────────────────────────────

function hs($gender, $n) {
    return "https://randomuser.me/api/portraits/{$gender}/{$n}.jpg";
}

// ─── EXPERT CLASSES ──────────────────────────────────────────────────────────

function bt_expert_classes() {
    return array_merge(
        _classes_character_integrity(),
        _classes_customer_results(),
        _classes_growth_change(),
        _classes_people_culture(),
        _classes_vision_strategy()
    );
}

function bt_classes_by_domain($slug) {
    $all = bt_expert_classes();
    $filtered = array_filter($all, fn($c) => $c['domain'] === $slug);
    usort($filtered, fn($a,$b) => strcmp($b['release_date'], $a['release_date']));
    return array_values($filtered);
}

function bt_expert_class($slug) {
    foreach (bt_expert_classes() as $c) { if ($c['slug'] === $slug) return $c; }
    return null;
}

function bt_lesson($class_slug, $n) {
    $class = bt_expert_class($class_slug);
    if (!$class) return null;
    foreach ($class['lessons'] as $l) { if ($l['number'] == $n) return $l; }
    return null;
}

// ─── LESSON BUILDER HELPERS ──────────────────────────────────────────────────

function lessons(...$items) {
    $out = [];
    foreach ($items as $i => $item) {
        $num = $i + 1;
        $out[] = ['number'=>$num, 'title'=>$item[0], 'duration'=>$item[1], 'locked'=>$num > 1];
    }
    return $out;
}

function ec($slug, $title, $expert, $title_role, $headshot, $domain, $competency, $date, $duration, $lessons_data, $extra=[]) {
    return array_merge([
        'slug'         => $slug,
        'title'        => $title,
        'expert_name'  => $expert,
        'expert_title' => $title_role,
        'headshot'     => $headshot,
        'domain'       => $domain,
        'competency'   => $competency,
        'release_date' => $date,
        'duration'     => $duration,
        'lessons'      => $lessons_data,
        'lesson_count' => count($lessons_data),
        'summary_l1'   => '',
        'transcript_l1'=> '',
        'prompts_l1'   => [],
        'video_id'     => '',
    ], $extra);
}

// ─── CHARACTER & INTEGRITY (32 classes) ──────────────────────────────────────

function _classes_character_integrity() {
    $d = 'character-and-integrity';
    return [

        // ── SHOWCASE ──────────────────────────────────────────────────────────
        ec('radical-respect-at-work','Radical Respect at Work','Kim Scott','Author, Radical Candor; Former Director, Apple & Google',hs('women',45),$d,'Inclusive Leadership','2024-11-01','42m',
            lessons(
                ['What Radical Respect Really Means','5m'],
                ['Recognizing Bias Without Weaponizing It','6m'],
                ['Addressing Prejudice in Real Time','5m'],
                ['How Bullying Differs From Feedback','7m'],
                ['Discrimination and the Manager\'s Role','6m'],
                ['Creating Conditions Where Everyone Thrives','5m'],
                ['Your Radical Respect Action Plan','4m']
            ),[
            'video_id'      => '1ZtdphVR',
            'summary_l1'    => 'In this opening lesson, Kim Scott introduces the framework of Radical Respect — a set of practices designed to create workplaces where every person feels valued and included. Scott distinguishes radical respect from mere politeness or performative inclusion: it\'s about creating the structural conditions where all employees can do their best work and bring their whole selves. Drawing on her decades of experience as a tech executive and her landmark book, Scott argues that most workplace dysfunction stems from three related but distinct failures: bias, prejudice, and bullying. Understanding how these differ — and how to respond to each — is the foundation of a respectful, high-performing culture.',
            'transcript_l1' => '"The word \'respect\' gets thrown around a lot in leadership circles, but it rarely gets examined. What does it actually mean to respect the people who work for you? I want to propose something more demanding than the usual platitudes: radical respect. Not just being polite. Not just following HR guidelines. But creating the genuine conditions where every person you work with can do their best work and be their best self. That\'s what this class is about. Over the next seven lessons, we\'re going to look at the three forces that undermine respect in the workplace — bias, prejudice, and bullying — and build a concrete toolkit for responding to each one. These aren\'t abstract concepts. They show up every day, in every organization, often without anyone intending harm. And that\'s precisely why we need a framework. Because good intentions aren\'t enough. What matters is what you actually do."',
            'prompts_l1'    => [
                'Think about a time when someone on your team didn\'t feel respected. What were the signals? What happened as a result? What might you do differently now?',
                'How does your organization currently address bias? Is that approach reactive or proactive — and what\'s the difference in impact?',
                'Where do you see the clearest gap between your team\'s stated values and its day-to-day behavior?',
            ],
        ]),

        ec('how-to-lead-with-integrity','How to Lead With Integrity','Steve Stoute','Founder & CEO, Translation; Music & Brand Strategist',hs('men',15),$d,'Ethics & Integrity','2024-08-15','38m',
            lessons(['Why Integrity Is a Business Strategy','6m'],['The Authenticity Gap','5m'],['Making Hard Calls in Public','6m'],['Leading Through Scrutiny','7m'],['Rebuilding Trust After a Mistake','6m'],['Integrity as Competitive Advantage','4m'])),

        ec('navigating-myths-bias-and-bluster','Navigating Myths, Bias & Bluster: A Critical Thinking Toolkit','Jill Tarter, Michio Kaku & Alex Edmans','Researchers & Thinkers',hs('women',74),$d,'Critical Thinking','2024-06-10','45m',
            lessons(['How We Form Beliefs','5m'],['The Science of Misinformation','6m'],['Cognitive Biases That Hijack Decision-Making','7m'],['Evaluating Evidence Like a Scientist','5m'],['Leading Cultures of Intellectual Rigor','6m'],['Building Your Critical Thinking Toolkit','4m'])),

        ec('the-espionage-edge','The Espionage Edge','Andrew Bustamante','Former CIA Covert Intelligence Officer',hs('men',38),$d,'Decision Making','2024-04-22','40m',
            lessons(['How Intelligence Professionals Think','6m'],['Reading People and Environments','5m'],['Deception, Persuasion & Influence','7m'],['High-Stakes Decision Making','6m'],['Managing Risk with Imperfect Information','5m'],['Applying Espionage Principles to Leadership','4m'])),

        ec('tools-for-thinking-critically','Tools for Thinking Critically','Daniel Dennett','Philosopher; Author, Breaking the Spell',hs('men',90),$d,'Critical Thinking','2024-03-05','36m',
            lessons(['What Good Thinking Actually Looks Like','6m'],['Intuition vs. Reason','5m'],['Identifying Your Own Blind Spots','5m'],['The Art of Changing Your Mind','6m'],['Constructing and Dismantling Arguments','6m'],['Thinking as a Leadership Practice','4m'])),

        ec('achieving-remarkable-things','Achieving Remarkable Things','John Amaechi OBE','Organizational Psychologist; Former NBA Player',hs('men',11),$d,'Personal Effectiveness','2024-01-18','41m',
            lessons(['Redefining What\'s Possible','6m'],['The Psychology of Exceptional Performance','5m'],['Identity and Self-Limiting Beliefs','7m'],['Discipline in the Absence of Motivation','5m'],['Making Courage a Habit','6m'],['Your Remarkable Future','4m'])),

        ec('on-communication-jefferson-fisher','On Communication','Jefferson Fisher','Trial Attorney; Communication Expert',hs('men',28),$d,'Communication','2023-11-12','35m',
            lessons(['Why Most People Communicate Poorly','5m'],['The Power of Pausing','4m'],['Saying Difficult Things With Grace','6m'],['Holding Your Ground Without Escalating','7m'],['Listening as a Leadership Tool','5m'],['The Art of Memorable Communication','4m'])),

        ec('writing-lessons-from-a-pulitzer-prize-winner','Writing Lessons From a Pulitzer Prize Winner','Lawrence Wright','Pulitzer Prize-Winning Author; Staff Writer, The New Yorker',hs('men',83),$d,'Communication','2023-10-03','38m',
            lessons(['Why Writing Is Thinking','5m'],['Finding the Story Worth Telling','6m'],['Clarity, Brevity, and the Ruthless Edit','7m'],['The Narrative Arc in Business Communication','5m'],['Writing Under Pressure','6m'],['Building a Voice That People Trust','4m'])),

        ec('lessons-in-resilience-from-a-zen-priest','Lessons in Resilience from a Zen Priest','Robert Waldinger, MD','Harvard Psychiatrist; Director, Harvard Study of Adult Development',hs('men',78),$d,'Resilience','2023-08-20','37m',
            lessons(['What Science Says About Resilience','6m'],['The Role of Relationships in Recovery','5m'],['Mindfulness and the Regulated Leader','6m'],['Sitting With Uncertainty','5m'],['Grief, Loss, and Leading Through It','7m'],['Building a Life That Lasts','4m'])),

        ec('the-power-of-wonder','The Power of Wonder','Monica Parker','Behavioral Scientist; Author, The Power of Wonder',hs('women',29),$d,'Personal Effectiveness','2023-07-14','33m',
            lessons(['Why Wonder Is a Leadership Competency','5m'],['Curiosity as a Business Asset','5m'],['Awe, Humility, and Strategic Vision','6m'],['Designing Wonder Into Your Culture','6m'],['Wonder and Well-Being at Work','5m'],['Practicing Wonder Daily','3m'])),

        ec('small-moves-to-outsize-leadership','On Small Moves to Outsize Your Leadership','John Amaechi OBE','Organizational Psychologist; Former NBA Player',hs('men',11),$d,'Personal Effectiveness','2023-06-05','32m',
            lessons(['The Compound Effect of Micro-Behaviors','5m'],['What Your Team Notices That You Don\'t','5m'],['The Ripple Effect of a Single Gesture','5m'],['Small Moves in Feedback','6m'],['Small Moves in Inclusion','5m'],['Building Your Small Moves Practice','3m'])),

        ec('critical-inquiry','Critical Inquiry','Alex Edmans','Professor of Finance, London Business School',hs('men',44),$d,'Critical Thinking','2023-04-18','40m',
            lessons(['Why Smart People Believe Wrong Things','6m'],['Cherry-Picking and Survivorship Bias','5m'],['Correlation, Causation, and the Stories We Tell','7m'],['Evaluating Expert Claims','6m'],['The Ethics of Evidence','5m'],['Becoming a More Rigorous Thinker','4m'])),

        ec('how-to-see-ourselves-as-planetary','How to See Ourselves as Planetary','Ron Garan','NASA Astronaut; Author, Orbital Perspective',hs('men',55),$d,'Ethics & Integrity','2023-03-22','34m',
            lessons(['The Overview Effect','6m'],['Systems Thinking from 250 Miles Up','5m'],['Shared Purpose and Global Challenges','5m'],['Leading With a Planetary Mindset','6m'],['Collaboration Across Divides','6m'],['Your Mission on Earth','3m'])),

        ec('leading-through-anxiety','Leading Through Anxiety','Jesse Eisenberg','Actor; Playwright; Mental Health Advocate',hs('men',17),$d,'Resilience','2023-02-10','30m',
            lessons(['What Anxiety Tells You','5m'],['Anxiety as Fuel vs. Paralysis','5m'],['The High-Performance Nervous System','6m'],['Radical Acceptance in Leadership','5m'],['Managing Anxiety in Others','5m'],['The Anxious Leader\'s Advantage','4m'])),

        ec('on-thinking-like-a-poker-player','On Thinking Like a Poker Player','Nate Silver','Statistician; Author, The Signal and the Noise',hs('men',34),$d,'Decision Making','2023-01-09','38m',
            lessons(['Probability Is Not Fate','6m'],['Reading Signals Through Noise','5m'],['Expected Value Thinking','6m'],['Calibrating Confidence','7m'],['Decision-Making Under Uncertainty','6m'],['The Long Game','4m'])),

        ec('problem-solving-with-different-minds','Problem-Solving With Different Minds','Temple Grandin','Professor of Animal Science; Autism Advocate',hs('women',71),$d,'Innovation','2022-11-15','36m',
            lessons(['Visual, Pattern, and Verbal Thinking','6m'],['Why Cognitive Diversity Solves Hard Problems','5m'],['Building Neurodiverse Teams','6m'],['The Visual Thinker\'s Superpower','5m'],['Communication Across Thinking Styles','6m'],['Designing for Different Minds','4m'])),

        ec('promoting-well-being-at-work','Promoting Well-Being at Work','Robert Waldinger, MD','Harvard Psychiatrist; Director, Harvard Study of Adult Development',hs('men',78),$d,'People & Culture','2022-09-20','33m',
            lessons(['The Science of Well-Being','5m'],['Relationships and Work Longevity','6m'],['Stress, Recovery, and the Resilient Organization','6m'],['Designing Workplaces for Human Flourishing','5m'],['The Manager\'s Role in Well-Being','5m'],['Your Well-Being Commitment','3m'])),

        ec('on-designing-a-fair-organization','On Designing a Fair Organization','Kim Scott','Author, Radical Candor; Former Director, Apple & Google',hs('women',45),$d,'Ethics & Integrity','2022-08-08','35m',
            lessons(['What Fairness Actually Requires','5m'],['Bias in Performance Review Systems','6m'],['Designing Fair Hiring Processes','5m'],['Pay Equity and Transparency','6m'],['When Fairness and Business Goals Conflict','6m'],['Building Your Fair Organization Playbook','4m'])),

        ec('career-development-series','Career Development Series','Jesse Eisenberg','Actor; Playwright; Career Coach',hs('men',17),$d,'Personal Effectiveness','2022-06-14','38m',
            lessons(['Defining Success on Your Own Terms','5m'],['The Courage to Pivot','6m'],['Building a Portfolio Career','6m'],['Mentorship and Sponsorship','5m'],['Negotiating What You\'re Worth','6m'],['The Long View on Career','4m'])),

        ec('no-nonsense-leadership','No-Nonsense Leadership','Ben Horowitz','Co-Founder, Andreessen Horowitz; Author, The Hard Thing About Hard Things',hs('men',60),$d,'Ethics & Integrity','2022-04-25','42m',
            lessons(['The Difference Between Hard and Good Leadership','6m'],['Telling the Truth When It Hurts','5m'],['Leading in a Crisis','7m'],['Hiring for Strength, Not Against Weakness','6m'],['Building a Culture of Accountability','6m'],['What Nobody Tells You About Being the Boss','5m'],['The CEO\'s Final Exam','4m'])),

        ec('the-ethics-of-influence','The Ethics of Influence','Dr. Sarah Chen','Professor of Business Ethics, Wharton School',hs('women',33),$d,'Ethics & Integrity','2022-03-10','34m',
            lessons(['The Line Between Persuasion and Manipulation','6m'],['Power, Authority, and Ethical Responsibility','5m'],['Influencing Without Misleading','5m'],['The Ethics of Nudging','6m'],['Whistleblowing and Moral Courage','6m'],['Building an Ethical Influence Toolkit','3m'])),

        ec('the-art-of-courageous-conversations','The Art of Courageous Conversations','Marcus Bell','Executive Coach; Former Fortune 100 CHRO',hs('men',5),$d,'Communication','2022-01-18','33m',
            lessons(['Why We Avoid Hard Conversations','5m'],['Preparing to Speak Courageously','5m'],['The Structure of a Difficult Conversation','6m'],['Staying Composed Under Fire','6m'],['When the Other Person Shuts Down','5m'],['Building a Culture of Candor','3m'])),

        ec('authentic-leadership-presence','Authentic Leadership Presence','Dr. Vanessa Brooks','Executive Coach; Author, Leading From the Inside Out',hs('women',40),$d,'Personal Effectiveness','2021-11-30','31m',
            lessons(['What Authenticity Is (and Isn\'t)','5m'],['Finding Your Leadership Voice','5m'],['Leading Across Contexts','5m'],['Vulnerability as Strength','5m'],['Presence Under Pressure','5m'],['Your Authentic Leadership Blueprint','3m'])),

        ec('building-trust-in-distributed-teams','Building Trust in Distributed Teams','James Okafor','Organizational Scientist; Author, Wired to Trust',hs('men',12),$d,'People & Culture','2021-10-15','34m',
            lessons(['The Trust Deficit in Remote Work','5m'],['Swift Trust and How to Build It','6m'],['Consistency as a Trust Signal','5m'],['Managing Across Time Zones and Cultures','6m'],['Trust Repair After a Breakdown','5m'],['The High-Trust Remote Culture','4m'])),

        ec('emotional-courage-in-leadership','Emotional Courage in Leadership','Patricia Delgado','Leadership Psychologist; Former Goldman Sachs Executive',hs('women',14),$d,'Personal Effectiveness','2021-08-22','32m',
            lessons(['What Emotional Courage Requires','5m'],['The Fear Beneath the Surface','5m'],['Naming Emotions Without Losing Authority','6m'],['Courage in Giving Feedback','6m'],['The Emotionally Courageous Culture','5m'],['Your Emotional Courage Practice','3m'])),

        ec('mindful-leadership-foundations','Mindful Leadership Foundations','Dr. Elena Marchetti','Mindfulness Researcher; Executive Coach',hs('women',55),$d,'Personal Effectiveness','2021-06-10','30m',
            lessons(['Why Leaders Need Mindfulness Now','5m'],['Presence as a Leadership Practice','5m'],['Mindful Decision-Making','5m'],['Managing Reactivity','5m'],['Mindfulness in High-Stakes Situations','5m'],['Building Your Mindfulness Practice','3m'])),

        ec('owning-your-leadership-story','Owning Your Leadership Story','Keisha Thompson','Spoken Word Artist; Leadership Facilitator',hs('women',19),$d,'Personal Effectiveness','2021-04-05','28m',
            lessons(['Why Your Story Matters','5m'],['Uncovering Your Defining Moments','5m'],['Reframing Setbacks as Assets','5m'],['Telling Your Story With Power','5m'],['Story as a Tool for Influence','4m'],['Your Leadership Narrative','3m'])),

        ec('leading-beyond-bias','Leading Beyond Bias','Dr. Andre Williams','Social Psychologist; DEI Strategist',hs('men',7),$d,'Inclusive Leadership','2021-02-18','36m',
            lessons(['How Bias Gets Into Decision-Making','6m'],['Structural vs. Interpersonal Bias','5m'],['The Inclusion Spectrum','5m'],['Interrupting Bias in Real Time','6m'],['Measuring Bias Reduction','6m'],['The Anti-Bias Leader','4m'])),

        ec('the-feedback-imperative','The Feedback Imperative','Maya Rodriguez','Executive Coach; Author, Feedback That Works',hs('women',27),$d,'Personal Effectiveness','2020-12-10','32m',
            lessons(['Why Feedback Fails','5m'],['The Neuroscience of Receiving Feedback','5m'],['Giving Feedback That Sticks','6m'],['Creating a Feedback-Rich Culture','6m'],['Upward Feedback and Its Power','5m'],['Feedback as a Daily Practice','3m'])),

        ec('character-under-pressure','Character Under Pressure','Col. Robert Sterling (Ret.)','Former U.S. Army Colonel; Leadership Strategist',hs('men',85),$d,'Ethics & Integrity','2020-10-20','35m',
            lessons(['Leadership in Extreme Conditions','6m'],['The Pressure Test of Your Values','5m'],['Decision-Making in the Fog of War','7m'],['Moral Injury and How to Recover','5m'],['Building Character Before the Crisis','5m'],['Character as Your Lasting Legacy','4m'])),

        ec('the-principled-leader','The Principled Leader','Dr. David Kimani','Professor of Leadership Ethics, Harvard Kennedy School',hs('men',24),$d,'Ethics & Integrity','2020-08-12','33m',
            lessons(['What Principles Are Worth Keeping','5m'],['When Principles Conflict','6m'],['Moral Reasoning Under Ambiguity','6m'],['Holding the Line Under Pressure','5m'],['Institutionalizing Principled Leadership','5m'],['Your Principles Manifesto','3m'])),

        ec('authenticity-at-scale','Authenticity at Scale','Sarah Okonkwo','Brand Strategist; Author, The Authentic Organization',hs('women',62),$d,'Personal Effectiveness','2020-06-01','30m',
            lessons(['The Authenticity Paradox in Large Organizations','5m'],['Scaling Culture Without Losing Soul','5m'],['Authentic Communication in the Age of PR','5m'],['Leading With Transparency','5m'],['Authenticity and Organizational Trust','5m'],['Designing the Authentic Organization','3m'])),

    ];
}

// ─── CUSTOMER & RESULTS ORIENTATION (30 classes) ─────────────────────────────

function _classes_customer_results() {
    $d = 'customer-and-results-orientation';
    return [

        ec('secrets-of-unreasonable-hospitality','The Secrets of Unreasonable Hospitality','Will Guidara','Former Co-Owner, Eleven Madison Park; Author, Unreasonable Hospitality',hs('men',32),$d,'Customer Experience','2024-10-14','45m',
            lessons(['What Unreasonable Hospitality Really Means','6m'],['Reading the Room Before They Speak','5m'],['The Magic of the Unexpected Gesture','6m'],['Empowering Your Team to Delight','7m'],['Hospitality as a Competitive Strategy','6m'],['Building Your Hospitality Playbook','5m'])),

        ec('creating-a-hospitality-first-culture','Creating a Hospitality-First Culture','Will Guidara','Former Co-Owner, Eleven Madison Park; Author, Unreasonable Hospitality',hs('men',32),$d,'Organizational Culture','2024-07-22','48m',
            lessons(['Culture Is What You Tolerate','5m'],['Hiring for Heart, Not Just Skill','6m'],['Onboarding That Instills Values','5m'],['Rituals and Their Cultural Power','6m'],['Accountability With Warmth','7m'],['When Culture Breaks Down','5m'],['Rebuilding and Sustaining Your Culture','5m'])),

        ec('grow-with-the-experience-mindset','Grow Your Business With the Experience Mindset','Tiffani Bova','Global Customer Growth & Innovation Evangelist; Author, Growth IQ',hs('women',22),$d,'Customer Experience','2024-05-18','40m',
            lessons(['The Experience Economy Has Arrived','5m'],['Mapping the Customer Journey','6m'],['The Employee-Customer Connection','6m'],['Turning Data Into Delight','5m'],['Scaling Experience Across the Organization','6m'],['Your Experience Mindset Action Plan','5m'])),

        ec('mastering-new-rules-of-branding','Mastering the New Rules of Branding','Gary Vaynerchuk','Chairman, VaynerX; CEO, VaynerMedia; Author, Jab, Jab, Jab, Right Hook',hs('men',35),$d,'Brand & Marketing','2024-02-10','44m',
            lessons(['Attention Is the New Currency','6m'],['The Platform Playbook','5m'],['Authentic Content at Scale','7m'],['Community Before Commerce','5m'],['Building a Brand That Lasts','6m'],['The Long Game in a Short-Term World','5m'],['Your Brand Audit','4m'])),

        ec('on-business-acumen','On Business Acumen','Carla Harris','Vice Chairman & Senior Client Advisor, Morgan Stanley',hs('women',51),$d,'Business Acumen','2023-12-05','38m',
            lessons(['The Language of Business','5m'],['Reading a Room Like a CFO','6m'],['Capital Allocation and What It Signals','6m'],['Stakeholder Management as Strategy','5m'],['Business Acumen and Career Acceleration','6m'],['Building Business Acumen at Every Level','4m'])),

        ec('selling-yourself-and-evaluating-ideas','Selling Yourself and Evaluating Ideas','Carla Harris','Vice Chairman & Senior Client Advisor, Morgan Stanley',hs('women',51),$d,'Communication','2023-09-18','36m',
            lessons(['Why Everyone Needs to Sell','5m'],['Your Personal Value Proposition','5m'],['The Pitch That Opens Doors','6m'],['Evaluating Ideas Like an Investor','6m'],['Navigating the Decision-Maker\'s Mind','6m'],['Selling With Confidence','4m'])),

        ec('storytelling-ensemble','Storytelling Ensemble','Tim O\'Reilly & Guests','Founder & CEO, O\'Reilly Media; Technology Futurist',hs('men',68),$d,'Communication','2023-08-01','50m',
            lessons(['Why Story Moves People to Act','6m'],['Structure: The Three-Act Framework for Business','6m'],['Data + Narrative: Making Numbers Human','7m'],['The Origin Story and Why It Matters','5m'],['Storytelling Across Cultures','6m'],['Crafting Your Signature Story','5m'],['Story as Strategy','5m'])),

        ec('how-to-succeed-in-business','How to Succeed in Business','Kevin O\'Leary & Michael Lee','Investor, Shark Tank; Serial Entrepreneur',hs('men',64),$d,'Business Acumen','2023-06-12','46m',
            lessons(['The Non-Negotiables of Business Success','6m'],['Managing Money Like It\'s Your Last Dollar','5m'],['Building a High-Performing Team','6m'],['Negotiation and Knowing Your Walk-Away','7m'],['Failing Forward','5m'],['The Business Instincts That Can\'t Be Taught','5m'],['Your Success Audit','4m'])),

        ec('ritz-carlton-leadership-lessons','Ritz-Carlton Leadership Lessons','Horst Schulze','Co-Founder, The Ritz-Carlton Hotel Company; Author, Excellence Wins',hs('men',79),$d,'Customer Experience','2023-05-08','42m',
            lessons(['The Standard-Bearer Mindset','6m'],['Excellence as a Non-Negotiable','5m'],['The Employee Who Defines Your Brand','6m'],['Consistency at Scale','7m'],['Turning Complaints Into Loyalty','5m'],['The Ritz-Carlton Credo in Practice','5m'],['Building Your Culture of Excellence','4m'])),

        ec('winning-the-moments-that-matter','Winning the Moments That Matter','Dr. Christine Yates','Customer Experience Researcher; Former Amazon VP',hs('women',36),$d,'Customer Experience','2023-03-22','35m',
            lessons(['Identifying the Moments That Make or Break You','5m'],['Peak-End Theory in Practice','6m'],['Designing for Memory, Not Just Satisfaction','5m'],['The Effort Equation','6m'],['Operationalizing Moments','6m'],['Your Moment Map','4m'])),

        ec('the-customer-centered-leader','The Customer-Centered Leader','Brandon Lee','CX Strategist; Author, The Outside-In Organization',hs('men',42),$d,'Customer Experience','2023-01-15','33m',
            lessons(['Outside-In Leadership','5m'],['Translating Customer Insight Into Action','5m'],['Breaking Organizational Silos for the Customer','6m'],['Leading CX in B2B','5m'],['Measuring What Customers Actually Value','6m'],['Your Customer-Centered Leadership Plan','4m'])),

        ec('revenue-growth-mindset','Revenue Growth Mindset','Priya Mehta','Chief Revenue Officer; Growth Strategist',hs('women',41),$d,'Business Acumen','2022-11-30','34m',
            lessons(['Revenue Is Everyone\'s Responsibility','5m'],['The Growth Funnel Revisited','5m'],['Pricing as a Strategic Tool','6m'],['Expanding in the Customer Base You Have','6m'],['Growth Metrics That Actually Matter','5m'],['Building Your Revenue Culture','4m'])),

        ec('leading-sales-excellence','Leading Sales Excellence','Carlos Reyes','VP of Sales, Fortune 50; Sales Leadership Coach',hs('men',20),$d,'Business Acumen','2022-10-10','38m',
            lessons(['What Great Sales Leaders Actually Do','6m'],['Building a Pipeline Culture','5m'],['Coaching to Win, Not Just to Manage','6m'],['The Forecasting Mindset','5m'],['Hiring Salespeople Who Can Hunt and Farm','6m'],['Accountability Without Micromanagement','5m'],['Sales Leadership at Scale','4m'])),

        ec('data-driven-decision-making','Data-Driven Decision Making','Dr. Aisha Johnson','Professor of Analytics, MIT Sloan',hs('women',37),$d,'Decision Making','2022-08-20','36m',
            lessons(['From Gut Feel to Data Fluency','5m'],['The Right Question Is Half the Answer','6m'],['Reading Dashboards That Actually Matter','5m'],['When Data and Instinct Conflict','6m'],['Building a Data Culture','6m'],['Leading With Evidence','4m'])),

        ec('the-art-of-negotiation','The Art of Negotiation','Thomas Burke','Professor of Negotiation, Harvard Law School',hs('men',58),$d,'Communication','2022-06-15','40m',
            lessons(['Interest vs. Position: The Foundation','6m'],['BATNA and Why It\'s Everything','5m'],['Reading the Negotiation Table','6m'],['Anchoring and Counter-Anchoring','7m'],['Multi-Party Negotiations','5m'],['Closing the Deal','5m'],['Your Negotiation Prep Sheet','4m'])),

        ec('delivering-on-the-promise','Delivering on the Promise','Dr. Yolanda Pierce','Customer Success Executive; Researcher',hs('women',48),$d,'Customer Experience','2022-04-08','32m',
            lessons(['The Promise as a Leadership Commitment','5m'],['Operational Excellence and the Customer','5m'],['When You Can\'t Deliver','6m'],['Turning Service Recovery Into Loyalty','5m'],['The Internal Service Standard','5m'],['Building the Promise-Keeping Organization','4m'])),

        ec('from-good-to-great-service','From Good to Great Service','Nathan Schulz','Service Design Expert; Author, The Service Blueprint',hs('men',47),$d,'Customer Experience','2022-02-22','30m',
            lessons(['The Service Mindset','5m'],['Designing for Ease and Delight','5m'],['Service Blueprinting','5m'],['Empowering Frontline Leaders','5m'],['Recovering Service Failures Brilliantly','5m'],['Your Great Service Roadmap','4m'])),

        ec('building-a-results-culture','Building a Results Culture','Diana Chen','COO; Author, Performance by Design',hs('women',26),$d,'Business Acumen','2021-12-12','35m',
            lessons(['Culture and Performance Are Not Separate','5m'],['Setting Goals That Actually Drive Behavior','6m'],['The Accountability Conversation','6m'],['Recognizing and Rewarding Results','5m'],['Leading High-Performing Teams','6m'],['Sustaining Your Results Culture','4m'])),

        ec('the-performance-equation','The Performance Equation','Marcus Webb','Executive Performance Coach; Author, Peak by Design',hs('men',16),$d,'Personal Effectiveness','2021-10-05','33m',
            lessons(['What High Performance Requires','5m'],['Managing Energy, Not Just Time','5m'],['The Focus Equation','6m'],['Recovery as a Performance Strategy','5m'],['Sustaining Excellence Over Time','6m'],['Your Performance Blueprint','4m'])),

        ec('metrics-that-drive-meaning','Metrics That Drive Meaning','Dr. Rachel Kim','Behavioral Economist; Author, Numbers That Move People',hs('women',30),$d,'Decision Making','2021-08-18','34m',
            lessons(['Why Most Metrics Are Backward','5m'],['Leading vs. Lagging Indicators','6m'],['Designing Metrics That Change Behavior','6m'],['The Unintended Consequences of Measurement','5m'],['Metrics and Meaning','5m'],['Building Your Metric Stack','4m'])),

        ec('operational-excellence-for-leaders','Operational Excellence for Leaders','Frank Okonjo','COO; Operational Strategy Advisor',hs('men',13),$d,'Business Acumen','2021-06-01','36m',
            lessons(['Operations as Strategy','5m'],['Process Improvement That Sticks','6m'],['The Leader\'s Role in Operational Excellence','5m'],['Managing Complexity Without Chaos','6m'],['Cross-Functional Alignment','6m'],['Continuous Improvement Culture','5m'],['Your Operational Excellence Blueprint','4m'])),

        ec('the-revenue-leaders-playbook','The Revenue Leader\'s Playbook','James Whitmore','Chief Commercial Officer; Revenue Growth Advisor',hs('men',53),$d,'Business Acumen','2021-04-14','35m',
            lessons(['The Revenue Leader\'s Mandate','5m'],['Aligning Sales, Marketing, and CS','6m'],['Revenue Ops and the Modern Stack','5m'],['Forecasting With Confidence','6m'],['Leading Through Revenue Pressure','6m'],['The Revenue Leader\'s Dashboard','4m'])),

        ec('customer-experience-excellence','Customer Experience Excellence','Dr. Sandra Reeves','CX Professor; Author, The Customer-First Company',hs('women',57),$d,'Customer Experience','2021-02-28','33m',
            lessons(['What CX Excellence Requires','5m'],['Voice of the Customer Programs That Work','6m'],['Journey Mapping for Leaders','5m'],['CX and the P&L','5m'],['Building a CX-Led Culture','6m'],['Your CX Excellence Roadmap','4m'])),

        ec('winning-enterprise-accounts','Winning Enterprise Accounts','Michael Osei','Enterprise Sales Leader; Author, The Enterprise Code',hs('men',9),$d,'Business Acumen','2020-12-20','38m',
            lessons(['Understanding How Enterprises Buy','6m'],['The Multi-Stakeholder Sale','5m'],['Executive Access and How to Earn It','6m'],['Navigating the Procurement Process','6m'],['Negotiating Enterprise Deals','5m'],['Building Enterprise Relationships That Last','5m'],['Your Enterprise Account Plan','4m'])),

        ec('the-brand-builders-mindset','The Brand Builder\'s Mindset','Lucia Fernandez','CMO; Brand Strategy Consultant',hs('women',23),$d,'Brand & Marketing','2020-10-15','32m',
            lessons(['Brand as Strategic Asset','5m'],['Purpose-Driven Brand Architecture','5m'],['Consistency Across Touchpoints','6m'],['Brand and Culture: The Inside-Out Imperative','5m'],['Measuring Brand Value','5m'],['Building Your Brand Brief','4m'])),

        ec('from-product-to-platform-thinking','From Product to Platform Thinking','Dr. Henry Chang','Technology Strategist; Platform Economics Researcher',hs('men',44),$d,'Business Acumen','2020-08-10','37m',
            lessons(['Why Platforms Win','6m'],['Network Effects and Competitive Moats','5m'],['Designing for Platform Dynamics','6m'],['Monetization in Platform Business Models','5m'],['The Platform Leader\'s Playbook','6m'],['Building Your Platform Strategy','5m'])),

        ec('sales-leadership-in-the-digital-age','Sales Leadership in the Digital Age','Alicia Morton','Global Sales Leader; Digital Sales Transformation Expert',hs('women',43),$d,'Business Acumen','2020-06-22','34m',
            lessons(['The Digitally Empowered Buyer','5m'],['Social Selling and Its Limits','5m'],['AI-Assisted Sales: What\'s Real','6m'],['The Human Element in Digital Sales','6m'],['Digital Sales Culture','5m'],['Your Digital Sales Transformation Plan','4m'])),

        ec('the-commercial-excellence-framework','The Commercial Excellence Framework','Dr. Felix Adeyemi','Professor of Strategy; Commercial Excellence Advisor',hs('men',18),$d,'Business Acumen','2020-04-15','36m',
            lessons(['What Commercial Excellence Demands','6m'],['The Revenue Architecture','5m'],['Incentive Design and Its Consequences','6m'],['Commercial Capability Building','5m'],['The Commercial Operating Rhythm','6m'],['Your Commercial Excellence Audit','4m'])),

        ec('customer-success-as-growth-engine','Customer Success as a Growth Engine','Rebecca Huang','Chief Customer Officer; CS Strategist',hs('women',31),$d,'Customer Experience','2020-02-20','33m',
            lessons(['CS Beyond Churn Prevention','5m'],['Expansion Revenue and How to Drive It','5m'],['The CS-Led Growth Playbook','6m'],['Health Scores That Predict the Future','5m'],['CS and the C-Suite Conversation','6m'],['Building Your CS Growth Engine','4m'])),

        ec('the-art-of-executive-selling','The Art of Executive Selling','Robert Castillo','Fortune 100 Sales Leader; Executive Sales Coach',hs('men',66),$d,'Communication','2020-01-10','35m',
            lessons(['Selling to the C-Suite','6m'],['What Executives Actually Care About','5m'],['Preparing for Executive Conversations','5m'],['The Business Case That Wins','6m'],['Navigating Executive Objections','6m'],['The Follow-Through That Closes','4m'])),

    ];
}

// ─── GROWTH & CHANGE (30 classes) ────────────────────────────────────────────

function _classes_growth_change() {
    $d = 'growth-and-change';
    return [

        ec('transform-your-org-with-ai','Transform Your Organization With AI','Daphne Koller','Co-Founder, Coursera; Founder & CEO, insitro; Stanford AI Professor',hs('women',66),$d,'Digital Leadership','2025-01-10','46m',
            lessons(['The AI Imperative for Leaders','6m'],['Understanding What AI Can (and Can\'t) Do','5m'],['Where AI Creates the Most Value','6m'],['Leading AI Transformation','7m'],['Managing the Human Side of AI Change','6m'],['Building Your AI Roadmap','5m'],['The AI-Ready Organization','4m'])),

        ec('the-ai-advantage','The AI Advantage','Ethan Mollick','Professor of Management, Wharton; AI Researcher; Author, Co-Intelligence',hs('men',31),$d,'Digital Leadership','2024-09-22','43m',
            lessons(['Why AI Changes Everything for Leaders','6m'],['The Centaur Strategy: Human + AI','5m'],['Using AI to Amplify Your Thinking','6m'],['The AI Productivity Revolution','7m'],['Navigating AI\'s Limitations','5m'],['Building Your AI Toolkit','5m'],['Leading in the Age of Co-Intelligence','4m'])),

        ec('ai-and-the-future-of-civilization','AI and the Future of Civilization','Yuval Noah Harari','Historian; Author, Sapiens, Homo Deus, 21 Lessons for the 21st Century',hs('men',81),$d,'Vision & Strategy','2024-07-15','50m',
            lessons(['Why AI Is Different From Every Previous Technology','7m'],['The Hacking of Human Decision-Making','6m'],['Democracy, Power, and the AI Revolution','7m'],['The Future of Work and Human Meaning','6m'],['Who Controls the Algorithm Controls the World','6m'],['What Leaders Must Do Now','5m'],['Questions Worth Living With','4m'])),

        ec('using-ai-to-create-amazing-things','Using AI to Create Amazing Things','Willonius Hatcher','AI Creative Director; Author, The Creative Machine',hs('men',8),$d,'Innovation','2024-06-01','38m',
            lessons(['AI as a Creative Partner','5m'],['Prompting for Quality Output','6m'],['AI in Design, Writing, and Strategy','6m'],['Building AI-Powered Workflows','5m'],['The Ethics of AI Creativity','5m'],['Your AI Creative Practice','4m'])),

        ec('ai-ensemble','AI Ensemble','Martin Gonzalez, Oliver Burkeman & Atul Gawande','Google, Author & Surgeon',hs('men',20),$d,'Digital Leadership','2024-04-10','54m',
            lessons(['Three Perspectives on Leading in the AI Era','7m'],['Productivity, Attention, and the AI Environment','6m'],['Medicine, Decision Support, and AI','6m'],['Organizational Design for AI Adoption','6m'],['The Human Premium in the AI Economy','6m'],['A Manifesto for AI Leadership','5m'])),

        ec('the-ai-organization','The AI Organization','Martin Gonzalez','Organizational Psychologist, Google; Author, Competing in the Age of AI',hs('men',20),$d,'Digital Leadership','2024-02-20','44m',
            lessons(['How AI Changes Organizational Design','6m'],['Talent Strategy in the Age of AI','5m'],['The AI-Enabled Team','6m'],['Retraining, Reskilling, and Resilience','7m'],['The Ethics of Automation','5m'],['Building the AI-Ready Organization','5m'],['Your AI Transformation Roadmap','4m'])),

        ec('leading-in-the-ai-age','Leading in the AI Age','Amanda Joiner','Chief AI Officer; Leadership & AI Strategist',hs('women',38),$d,'Digital Leadership','2023-12-08','41m',
            lessons(['The AI Leadership Moment','5m'],['AI Fluency for Non-Technical Leaders','6m'],['Managing Teams That Work With AI','6m'],['AI Ethics and Responsible Deployment','5m'],['The AI Change Management Challenge','7m'],['Your AI Leadership Playbook','5m'],['Leading the Human Side of AI','4m'])),

        ec('how-to-launch-ml-projects','How to Launch Machine Learning Projects','Eric Siegel','Founder, Predictive Analytics World; Author, The AI Playbook',hs('men',47),$d,'Digital Leadership','2023-10-15','40m',
            lessons(['The Business Case for Machine Learning','6m'],['Choosing the Right Problem','5m'],['Data: The Foundation Everything Rests On','6m'],['Managing the ML Project','7m'],['Measuring Business Impact','5m'],['Scaling What Works','5m'],['Your ML Launch Checklist','4m'])),

        ec('slow-productivity','Slow Productivity','Cal Newport','Professor of Computer Science, Georgetown; Author, Deep Work',hs('men',26),$d,'Personal Effectiveness','2023-09-05','37m',
            lessons(['Why Fast Is Broken','5m'],['The Three Principles of Slow Productivity','6m'],['Do Fewer Things','5m'],['Work at a Natural Pace','6m'],['Obsess Over Quality','5m'],['Redesigning Your Work Life','6m'],['The Slow Productivity Commitment','4m'])),

        ec('productivity-for-mortals','Productivity for Mortals','Oliver Burkeman','Journalist; Author, Four Thousand Weeks',hs('men',49),$d,'Personal Effectiveness','2023-07-20','35m',
            lessons(['The Finitude Problem','5m'],['Why Time Management Doesn\'t Work','6m'],['Embrace the Uncomfortable Choices','5m'],['The Joy of Missing Out','5m'],['Patience as a Superpower','6m'],['A Life Well-Spent','4m'])),

        ec('redesigning-work-for-21st-century','Redesigning Work for the 21st Century','Lynda Gratton','Professor of Management Practice, London Business School; Author, The Shift',hs('women',58),$d,'Organizational Culture','2023-06-10','44m',
            lessons(['The Forces Reshaping Work','6m'],['The Energy Revolution in Work','5m'],['Designing Hybrid Work That Actually Works','7m'],['The Future of Teams','6m'],['The Long Career and What It Demands','5m'],['Learning as a Way of Life','5m'],['Designing Your Future of Work','4m'])),

        ec('becoming-a-modern-elder','Becoming a Modern Elder','Chip Conley','Founder, MEA; Author, Wisdom@Work; Former Head of Global Hospitality at Airbnb',hs('men',72),$d,'Personal Effectiveness','2023-04-25','39m',
            lessons(['The Modern Elder\'s Advantage','5m'],['EQ Over IQ: The Wisdom Premium','5m'],['Learning While Leading','6m'],['Mentoring and Being Mentored in Reverse','6m'],['The Midlife Leadership Reset','6m'],['Designing Your Next Chapter','5m'],['The Modern Elder\'s Manifesto','4m'])),

        ec('surfing-the-ai-tsunami','Surfing the AI Tsunami','Michael Watkins','Professor, IMD Business School; Author, The First 90 Days',hs('men',52),$d,'Change Management','2023-03-12','42m',
            lessons(['The Wave Is Already Here','5m'],['Mapping AI\'s Impact on Your Industry','6m'],['Leading Your Organization Through AI Disruption','7m'],['Reskilling Your Team for the AI Era','5m'],['The Change Leader\'s Role in AI Adoption','6m'],['Riding the Wave: Your AI Transition Plan','5m'],['Thriving in the New Normal','4m'])),

        ec('on-firing-and-more','On Firing and More','Kim Scott & Josh Bersin','Author, Radical Candor & HR Industry Analyst',hs('women',45),$d,'People & Culture','2023-01-30','38m',
            lessons(['The Decision to Let Someone Go','5m'],['How to Have the Conversation','6m'],['Legal, Ethical, and Emotional Minefields','5m'],['The Team\'s Response','6m'],['Hiring Better to Fire Less','6m'],['The HR Partnership','5m'],['Building Cultures of Honest Feedback','4m'])),

        ec('leading-through-disruption','Leading Through Disruption','Dr. Angela Foster','Former McKinsey Partner; Author, The Disruption Advantage',hs('women',25),$d,'Change Management','2022-12-05','37m',
            lessons(['Disruption Is the New Normal','5m'],['The Disruption Radar','6m'],['Leading When the Map Has Changed','6m'],['Building Adaptive Capacity','5m'],['Communicating Through Disruption','6m'],['The Disruption-Ready Organization','5m'],['Your Disruption Playbook','4m'])),

        ec('the-change-leaders-playbook','The Change Leader\'s Playbook','Samuel Torres','Organizational Change Expert; Author, Change or Die Trying',hs('men',19),$d,'Change Management','2022-10-18','36m',
            lessons(['Why 70% of Change Initiatives Fail','6m'],['The Change Architecture','5m'],['Coalition Building for Change','6m'],['The Communication Plan That Works','5m'],['Managing Resistance','6m'],['Sustaining Change After Launch','5m'],['The Change Leader\'s Checklist','4m'])),

        ec('agile-thinking-for-senior-leaders','Agile Thinking for Senior Leaders','Dr. Mei Lin','Organizational Behavior Researcher; Agile Leadership Coach',hs('women',39),$d,'Innovation','2022-08-30','33m',
            lessons(['Agile Beyond Software','5m'],['The Leader\'s Role in Agile Organizations','6m'],['Decision Velocity','5m'],['OKRs and Adaptive Goal Setting','5m'],['Psychological Safety and Experimentation','5m'],['Building Your Agile Leadership Practice','4m'])),

        ec('innovation-at-scale','Innovation at Scale','Roberto Silva','Chief Innovation Officer; Author, The Innovation Engine',hs('men',50),$d,'Innovation','2022-06-25','38m',
            lessons(['Why Innovation Dies at Scale','6m'],['The Ambidextrous Organization','5m'],['Building Innovation Infrastructure','6m'],['Portfolio Management for Innovation','5m'],['Incentivizing Risk-Taking','6m'],['The Innovation Operating System','5m'],['Your Innovation Roadmap','4m'])),

        ec('digital-transformation-leadership','Digital Transformation Leadership','Dr. Jennifer Walsh','Digital Transformation Expert; Author, The Digital Leader',hs('women',46),$d,'Digital Leadership','2022-04-12','40m',
            lessons(['What Digital Transformation Actually Means','5m'],['Technology Is Not the Strategy','6m'],['Leading the Human Side of Digital Change','7m'],['Platform Thinking for Traditional Leaders','5m'],['Data Strategy and the Modern Leader','5m'],['Your Digital Transformation Blueprint','5m'],['The Digital Leader\'s Mindset','4m'])),

        ec('from-chaos-to-clarity','From Chaos to Clarity','Patricia Osei','Organizational Psychologist; Executive Coach',hs('women',14),$d,'Change Management','2022-02-08','32m',
            lessons(['Why Organizations Drift Into Chaos','5m'],['Finding Signal in the Noise','5m'],['Prioritization Under Uncertainty','6m'],['Communication That Creates Clarity','5m'],['Designing for Simplicity','5m'],['The Clarity Practice','4m'])),

        ec('building-adaptive-organizations','Building Adaptive Organizations','Dr. Mark Steinberg','Professor of Organizational Design, INSEAD',hs('men',56),$d,'Change Management','2021-12-20','36m',
            lessons(['The Adaptive Organization Defined','5m'],['Sensing and Responding','6m'],['The Modular Organization','5m'],['Dynamic Resource Allocation','6m'],['Leadership in Adaptive Systems','6m'],['Building Your Adaptive Blueprint','5m'],['Sustaining Adaptability','4m'])),

        ec('the-future-ready-leader','The Future-Ready Leader','Alicia Grant','Futurist; Author, Leading Tomorrow, Today',hs('women',28),$d,'Vision & Strategy','2021-10-15','34m',
            lessons(['What Future-Readiness Requires','5m'],['Scenario Planning in Practice','6m'],['Building the Future-Ready Team','5m'],['Technology Foresight for Leaders','6m'],['The Future-Ready Culture','5m'],['Your Future-Readiness Audit','4m'])),

        ec('navigating-organizational-change','Navigating Organizational Change','Dr. Christopher Paul','Change Management Professor; Author, The Human Side of Change',hs('men',61),$d,'Change Management','2021-08-08','35m',
            lessons(['The Change Curve and Its Leadership Implications','5m'],['Leading Hearts, Not Just Minds','6m'],['Stakeholder Mapping for Change','5m'],['Communication Cadence Through Change','6m'],['The Resistance Conversation','6m'],['Embedding Change in Culture','4m'])),

        ec('thriving-in-the-unknown','Thriving in the Unknown','Simone Arcadia','Performance Coach; Author, Comfortable With Uncertainty',hs('women',34),$d,'Resilience','2021-06-01','30m',
            lessons(['The Gift of Not Knowing','5m'],['Uncertainty Tolerance as a Leadership Skill','5m'],['Decision Confidence Without Perfect Information','5m'],['Leading Others Through Ambiguity','5m'],['Building Uncertainty Into Your Planning','5m'],['Your Uncertainty Practice','3m'])),

        ec('leading-in-age-of-uncertainty','Leading in the Age of Uncertainty','Dr. Thomas Wu','Global Risk Advisor; Author, The Uncertainty Edge',hs('men',67),$d,'Change Management','2021-04-18','36m',
            lessons(['The Permanent State of Uncertainty','5m'],['Risk Intelligence for Leaders','6m'],['Scenario Planning and Decision Trees','5m'],['Building Confidence Under Uncertainty','6m'],['Communicating Through Crisis','6m'],['Uncertainty Leadership at Scale','4m'])),

        ec('organizational-agility-at-scale','Organizational Agility at Scale','Marie Bouchard','Chief Transformation Officer; Author, The Agile Enterprise',hs('women',52),$d,'Change Management','2021-02-25','38m',
            lessons(['Agility vs. Speed','5m'],['The Agile Enterprise Architecture','6m'],['Leadership Behaviors That Enable Agility','6m'],['Governance in Agile Systems','5m'],['Scaling Agile Across the Enterprise','6m'],['The Agility Audit','5m'],['Your Agile Enterprise Roadmap','4m'])),

        ec('the-transformation-leader','The Transformation Leader','Dr. Kevin Adebisi','Transformation & Strategy Professor; Former BCG Partner',hs('men',29),$d,'Change Management','2020-12-10','37m',
            lessons(['What Transformation Really Means','6m'],['The Transformation Leader\'s Toolkit','5m'],['Leading Transformation at Scale','6m'],['Stakeholder Management in Transformation','5m'],['Sustaining Momentum','6m'],['The Transformation Leader\'s Legacy','5m'],['Your Transformation Roadmap','4m'])),

        ec('change-fatigue-and-how-to-fight-it','Change Fatigue and How to Fight It','Dr. Jessica Palmer','Organizational Health Researcher; Author, The Exhausted Organization',hs('women',21),$d,'Change Management','2020-10-05','32m',
            lessons(['The Change Fatigue Epidemic','5m'],['Signs Your Organization Is Saturated','5m'],['Pacing Change for Sustainability','5m'],['Communication That Energizes','5m'],['Recovery Strategies for Leaders','5m'],['The Change-Healthy Organization','4m'])),

        ec('rethinking-work-for-the-ai-era','Rethinking Work for the AI Era','Andre Bergström','Future of Work Researcher; Author, After Automation',hs('men',37),$d,'Digital Leadership','2020-07-20','35m',
            lessons(['What AI Does to Jobs (Really)','5m'],['The Tasks That Remain Human','6m'],['Designing Work in the AI Era','6m'],['Leading the Workforce Transition','5m'],['The Social Contract of AI Employment','5m'],['Your Future of Work Strategy','4m'])),

        ec('the-innovation-mindset','The Innovation Mindset','Dr. Nadia Kowalski','Innovation Psychologist; Author, Think Like an Innovator',hs('women',63),$d,'Innovation','2020-05-15','33m',
            lessons(['What an Innovative Mindset Looks Like','5m'],['Questioning Assumptions','5m'],['Embracing Failure as Data','5m'],['Cross-Pollination of Ideas','6m'],['Building Your Creative Habit','5m'],['The Innovation Mindset at Scale','4m'])),

    ];
}

// ─── PEOPLE & CULTURE (32 classes) ────────────────────────────────────────────

function _classes_people_culture() {
    $d = 'people-and-culture';
    return [

        ec('the-best-boss-ensemble','Best Boss Ensemble','Steve Stoute, Kim Scott, Jefferson Fisher, Josh Bersin, Atul Gawande & Daphne Koller','Leaders in Culture, Management & Learning',hs('men',15),$d,'People & Culture','2025-02-01','58m',
            lessons(['What Every Great Boss Does','6m'],['The Manager\'s Most Important Conversation','5m'],['Trust, Respect, and Psychological Safety','6m'],['Developing Your People','6m'],['Navigating Conflict in Teams','5m'],['The Inclusive Boss','5m'],['The Learning Culture','5m'],['Your Best Boss Blueprint','4m'])),

        ec('on-hr-organizational-transformation','On HR & Organizational Transformation','Josh Bersin','Global HR Industry Analyst & Researcher; Author, Irresistible',hs('men',61),$d,'Organizational Culture','2024-12-10','44m',
            lessons(['The New Mandate for HR','5m'],['From HR Business Partner to Strategic Leader','6m'],['Talent Intelligence in the AI Era','6m'],['The Skills-Based Organization','7m'],['Learning as a Business Strategy','5m'],['Culture Measurement and Change','5m'],['The HR Leader\'s Transformation Roadmap','4m'])),

        ec('leadership-lessons-from-the-operating-room','Leadership Lessons From the Operating Room','Atul Gawande, MD','Surgeon; Author, The Checklist Manifesto; Former Director, USAID',hs('men',43),$d,'People & Culture','2024-10-05','46m',
            lessons(['The Checklist as a Leadership Tool','5m'],['When the Smartest Person in the Room Is Wrong','6m'],['Psychological Safety and the Team Error','7m'],['Coaching in High-Stakes Environments','6m'],['Building a Culture of Learning From Failure','6m'],['The Leader as System Designer','5m'],['Your Operating Room Leadership Principles','4m'])),

        ec('the-team-leaders-guide','The Team Leader\'s Guide to Leadership and Management','Suzy Welch','Business Journalist; Author, 10-10-10; Former Editor, Harvard Business Review',hs('women',63),$d,'People & Culture','2024-08-18','40m',
            lessons(['The Manager-Leader Distinction','5m'],['Setting Direction Without Micromanaging','6m'],['The Performance Conversation','6m'],['Building a Team Identity','5m'],['Managing Up as Well as Down','6m'],['The Team Leader\'s Weekly Rituals','5m'],['Your Leadership Management System','4m'])),

        ec('making-the-leap-to-leadership','Making the Leap to Leadership','Adam Bryant','Senior Managing Director, Russell Reynolds Associates; Author, The Corner Office',hs('men',42),$d,'People & Culture','2024-06-24','39m',
            lessons(['What Changes When You Become a Leader','5m'],['The Identity Shift','5m'],['From Individual Contributor to Team Builder','6m'],['The First 90 Days as a Leader','7m'],['Common Mistakes New Leaders Make','5m'],['Building Credibility Quickly','5m'],['Your Leadership Transition Plan','4m'])),

        ec('sustaining-excellence-with-ei','Sustaining Excellence With Emotional Intelligence','Daniel Goleman','Psychologist; Author, Emotional Intelligence; Science Journalist',hs('men',77),$d,'Emotional Intelligence','2024-05-12','43m',
            lessons(['Why EI Predicts Leadership Success','5m'],['Self-Awareness as a Leadership Edge','6m'],['Regulating Emotion Under Pressure','6m'],['Empathy and the High-Performing Team','7m'],['Social Skills and Organizational Influence','5m'],['Building EI Into Your Culture','5m'],['Your EI Development Plan','4m'])),

        ec('leading-others-toward-happiness','Leading Others (and Yourself) Toward Happiness','Daniel Goleman, Cal Newport & Chip Conley','Psychologist, Author & Entrepreneur',hs('men',77),$d,'Well-Being','2024-03-01','50m',
            lessons(['The Science of Happiness at Work','6m'],['Flow, Deep Work, and Sustainable Performance','6m'],['Wisdom and Wellbeing in the Second Half of Career','5m'],['Creating a Happiness-Positive Culture','7m'],['The Leader\'s Own Wellbeing','5m'],['Happiness and Organizational Performance','6m'],['Your Happiness Leadership Agenda','4m'])),

        ec('resilient-to-risk','Resilient to Risk','Gen. Stanley McChrystal (Ret.) & Anna Butrico','Commander; Author, Team of Teams & Aviation Risk Specialist',hs('men',86),$d,'Resilience','2023-11-28','48m',
            lessons(['What Risk Intelligence Really Means','6m'],['Building Shared Consciousness Across Teams','5m'],['Decentralized Decision-Making','7m'],['Leading in Complex, Adaptive Systems','6m'],['The Human Factors of Risk','5m'],['Risk-Resilient Culture','5m'],['Your Risk Leadership Framework','4m'])),

        ec('on-a-directors-guide-to-leadership','On a Director\'s Guide to Leadership','Kevin Smith','Author, Director; Storytelling & Leadership Expert',hs('men',23),$d,'Communication','2023-09-14','37m',
            lessons(['What Directors Know That Managers Don\'t','5m'],['The Art of Casting Your Team','6m'],['Vision Clarity and Creative Direction','5m'],['Managing Creative Tension','6m'],['The Director\'s Note: Giving Feedback','6m'],['The Scene as a Metaphor for Work','5m'],['Your Leadership Director\'s Cut','4m'])),

        ec('people-and-culture-on-firing','Managing Out With Integrity','Kim Scott & Josh Bersin','Author, Radical Candor & HR Industry Analyst',hs('women',45),$d,'People & Culture','2023-07-20','36m',
            lessons(['The Decision Framework','5m'],['The Termination Conversation','6m'],['Legal Compliance and Human Dignity','6m'],['Supporting the Remaining Team','5m'],['The Aftermath and What It Reveals','5m'],['Hiring Practices That Reduce Firing','5m'],['Building Cultures of Early Feedback','4m'])),

        ec('ritz-carlton-team-culture','Ritz-Carlton: Building a Culture of Excellence','Horst Schulze','Co-Founder, The Ritz-Carlton Hotel Company',hs('men',79),$d,'Organizational Culture','2023-06-05','40m',
            lessons(['The Credo as Cultural Compass','6m'],['Empowering Employees to Own the Experience','5m'],['Training That Creates True Believers','6m'],['Standards Without Rigidity','5m'],['The Manager\'s Role in Culture','6m'],['Sustaining Culture Through Leadership Transitions','5m'],['Your Culture Architecture','4m'])),

        ec('redesigning-work-people-culture','Redesigning Work for the 21st Century','Lynda Gratton','Professor of Management Practice, London Business School',hs('women',58),$d,'Organizational Culture','2023-04-18','42m',
            lessons(['The Hybrid Work Imperative','5m'],['Designing for Connection and Collaboration','6m'],['Flexibility as an Equity Issue','5m'],['The Manager\'s Role in Hybrid Teams','7m'],['Work Design for Deep Focus','5m'],['The Social Architecture of Work','6m'],['Your Work Redesign Blueprint','4m'])),

        ec('daphne-koller-leading-to-win','Daphne Koller on Leading to Win','Daphne Koller','Co-Founder, Coursera; Founder & CEO, insitro; Stanford AI Professor',hs('women',66),$d,'People & Culture','2023-02-28','41m',
            lessons(['What It Means to Lead to Win','5m'],['Building the Learning Organization','6m'],['Talent as Competitive Strategy','6m'],['The Leader\'s Role in Innovation Culture','7m'],['Execution Excellence','5m'],['Building Winning Teams','5m'],['Your Winning Leadership System','4m'])),

        ec('becoming-a-modern-elder-pc','The Modern Elder\'s Guide to Team Leadership','Chip Conley','Founder, MEA; Former Head of Global Hospitality, Airbnb',hs('men',72),$d,'People & Culture','2023-01-10','36m',
            lessons(['Leading Across Generations','5m'],['Wisdom Transfer and Its Value','6m'],['The Mentor-Mentee Dynamic Reimagined','5m'],['Managing Younger Leaders','6m'],['The Multi-Generational Team\'s Strengths','5m'],['Building Intergenerational Respect','5m'],['Your Modern Elder Team Playbook','4m'])),

        ec('promoting-wellbeing-pc','Promoting Well-Being at Work','Robert Waldinger, MD','Harvard Psychiatrist; Director, Harvard Study of Adult Development',hs('men',78),$d,'Well-Being','2022-11-22','34m',
            lessons(['What the Longest Study of Happiness Reveals','5m'],['Relationships as the Foundation of Performance','6m'],['The Manager\'s Role in Well-Being','6m'],['Burnout: Prevention and Recovery','5m'],['Designing the Well-Being Conversation','5m'],['Your Well-Being Leadership Agenda','4m'])),

        ec('the-power-of-wonder-pc','The Power of Wonder','Monica Parker','Behavioral Scientist; Author, The Power of Wonder',hs('women',29),$d,'Well-Being','2022-09-15','33m',
            lessons(['Wonder as an Organizational Imperative','5m'],['Curiosity Culture','5m'],['The Psychological Safety-Wonder Connection','6m'],['Wonder in Team Meetings','5m'],['Leading With Awe and Humility','6m'],['Building Your Wonder Practice','4m'])),

        ec('small-moves-pc','On Small Moves to Outsize Your Leadership','John Amaechi OBE','Organizational Psychologist; Former NBA Player',hs('men',11),$d,'People & Culture','2022-07-20','31m',
            lessons(['Micro-Behaviors and Team Culture','5m'],['The Language of Inclusion','5m'],['Recognition at Scale','5m'],['The Listening Leader','5m'],['Consistency as a Cultural Signal','5m'],['Your Small Moves Inventory','4m'])),

        ec('leading-through-anxiety-pc','Leading Through Anxiety','Jesse Eisenberg','Actor; Playwright; Mental Health Advocate',hs('men',17),$d,'Well-Being','2022-05-10','30m',
            lessons(['The Anxious Team','5m'],['Creating Psychological Safety for Anxious Employees','5m'],['Performance Under Pressure','5m'],['Anxiety in Leadership Transitions','5m'],['Building a Culture of Compassion','5m'],['The Well-Regulated Organization','4m'])),

        ec('coaching-for-high-performance','Coaching for High Performance','Dr. Tanya Rivers','ICF Master Certified Coach; Author, Coach to Win',hs('women',18),$d,'Coaching & Development','2022-03-05','38m',
            lessons(['The Coaching Mindset','5m'],['The GROW Model in Practice','6m'],['Coaching vs. Managing','5m'],['Coaching for Development, Not Just Performance','6m'],['Difficult Coaching Conversations','6m'],['Group and Team Coaching','5m'],['Building a Coaching Culture','4m'])),

        ec('psychological-safety-advantage','The Psychological Safety Advantage','Dr. Kenji Mori','Organizational Psychologist; Author, Safety to Succeed',hs('men',57),$d,'People & Culture','2022-01-18','36m',
            lessons(['What Psychological Safety Really Is','5m'],['The Four Stages of Psychological Safety','6m'],['How Leaders Undermine Safety Without Knowing','5m'],['Building Safety Through Feedback','6m'],['Psychological Safety and Innovation','6m'],['Measuring and Growing Safety','4m'])),

        ec('belonging-at-work','Belonging at Work','Alicia Santiago','DEI Strategist; Author, The Belonging Playbook',hs('women',35),$d,'Inclusive Leadership','2021-11-20','34m',
            lessons(['Belonging vs. Inclusion: The Difference','5m'],['The Belonging Drivers','6m'],['When People Feel Like Outsiders','5m'],['The Manager\'s Role in Belonging','6m'],['Measuring Belonging','5m'],['Building Your Belonging Agenda','4m'])),

        ec('managing-multigenerational-teams','Managing the Multi-Generational Team','Dr. Helen Park','Generational Researcher; Author, The Five-Generation Workplace',hs('women',59),$d,'People & Culture','2021-09-15','36m',
            lessons(['Generational Myths and Realities','5m'],['Communication Across Generations','6m'],['Managing Boomer-Millennial Tension','5m'],['Gen Z in the Workplace','6m'],['The Generational Diversity Advantage','6m'],['Your Multi-Generational Team Playbook','4m'])),

        ec('the-culture-builders','The Culture Builders','Nathan Wallace','Chief People Officer; Author, Culture Deliberately',hs('men',27),$d,'Organizational Culture','2021-07-10','35m',
            lessons(['Culture Is Not a Perk','5m'],['The Culture Architecture','5m'],['Hiring for Cultural Alignment','6m'],['Onboarding as Culture-Setting','5m'],['Leadership Behaviors That Define Culture','6m'],['Sustaining Culture Through Change','5m'],['Your Culture Builder\'s Toolkit','4m'])),

        ec('developing-next-gen-leaders','Developing Your Next Generation Leaders','Isabelle Ferrand','Talent Development Expert; Author, The Leadership Pipeline Reimagined',hs('women',69),$d,'Coaching & Development','2021-05-05','37m',
            lessons(['Identifying Future Leaders','5m'],['The 70-20-10 Model in Practice','6m'],['Stretch Assignments and Why They Matter','5m'],['Sponsorship vs. Mentorship','6m'],['Succession Planning That Works','6m'],['Building Your Leadership Pipeline','5m'],['The Next Gen Leader\'s Development Plan','4m'])),

        ec('the-compassionate-leader','The Compassionate Leader','Dr. Omar Hassan','Clinical Psychologist; Author, Leading With Care',hs('men',48),$d,'Well-Being','2021-03-20','32m',
            lessons(['What Compassionate Leadership Requires','5m'],['Empathy Without Losing Boundaries','5m'],['The Compassion-Performance Link','5m'],['Leading Through Grief and Loss','5m'],['Self-Compassion for Leaders','6m'],['Building a Caring Culture','4m'])),

        ec('navigating-difficult-conversations-pc','Navigating Difficult Conversations','Lynn Chambers','Mediator; Author, The Conflict-Capable Leader',hs('women',41),$d,'Communication','2021-01-12','35m',
            lessons(['Why Difficult Conversations Fail','5m'],['Preparation: The Key to Confidence','5m'],['Opening Without Triggering Defensiveness','6m'],['Staying in the Conversation','6m'],['Finding Resolution','6m'],['The Follow-Up That Cements Change','4m'])),

        ec('building-resilient-teams','Building Resilient Teams','Dr. Anthony Ross','Organizational Resilience Researcher; Author, Bounce Forward',hs('men',54),$d,'Resilience','2020-11-08','36m',
            lessons(['Team Resilience vs. Individual Resilience','5m'],['The Four Pillars of Team Resilience','6m'],['Leading After a Setback','6m'],['Stress Testing Your Team','5m'],['Recovery Rituals for Teams','6m'],['The Resilient Team Framework','4m'])),

        ec('inclusive-team-dynamics','Inclusive Team Dynamics','Sandra Obi','Inclusion Consultant; Author, The Inclusive Team',hs('women',32),$d,'Inclusive Leadership','2020-09-01','34m',
            lessons(['What Inclusion Looks Like in Practice','5m'],['The Cost of Exclusion','5m'],['Psychological Safety and Inclusion','6m'],['Inclusive Meeting Practices','5m'],['Equity vs. Equality in Team Design','6m'],['Building Your Inclusive Team Charter','4m'])),

        ec('psychological-safety-in-practice','Psychological Safety in Practice','Dr. Marcus Lee','Researcher; Amy Edmondson Lab Alumni',hs('men',10),$d,'People & Culture','2020-07-15','33m',
            lessons(['The Research Behind Psychological Safety','5m'],['What Leaders Do That Kills Safety','5m'],['Building Safety Through Questions','5m'],['Failure Recovery as a Culture Moment','6m'],['Safety at Scale','6m'],['Your Psychological Safety Audit','4m'])),

        ec('the-human-centered-leader','The Human-Centered Leader','Valentina Cruz','Human-Centered Design Leader; Author, The Empathy Organization',hs('women',16),$d,'People & Culture','2020-05-20','31m',
            lessons(['Human-Centered Design Principles for Leaders','5m'],['Listening at Organizational Scale','5m'],['Designing Employee Experiences','5m'],['The Feedback Loop','5m'],['Human-Centered Decision Making','5m'],['Building Your Human-Centered Practice','4m'])),

        ec('leading-teams-through-transitions','Leading Teams Through Transitions','Dr. Pierre Lefebvre','Organizational Psychologist; Change Leadership Researcher',hs('men',73),$d,'Change Management','2020-03-10','35m',
            lessons(['Why Transitions Are Hard','5m'],['The Emotional Curve of Transition','6m'],['Individual vs. Team Transition Dynamics','5m'],['Communication Strategies for Transitions','6m'],['Maintaining Performance During Change','6m'],['The Post-Transition Integration','4m'])),

    ];
}

// ─── VISION & STRATEGY (30 classes) ──────────────────────────────────────────

function _classes_vision_strategy() {
    $d = 'vision-and-strategy';
    return [

        // ── SHOWCASE ──────────────────────────────────────────────────────────
        ec('the-6-disciplines-of-strategic-thinking','The 6 Disciplines of Strategic Thinking','Michael Watkins','Professor, IMD Business School; Author, The First 90 Days',hs('men',52),$d,'Strategic Planning','2024-11-18','52m',
            lessons(
                ['What Strategic Thinking Actually Is','6m'],
                ['Pattern Recognition: Seeing What Others Miss','7m'],
                ['Systems Thinking and Second-Order Effects','6m'],
                ['The Art of Strategic Abstraction','5m'],
                ['Visioning: Creating Compelling Futures','6m'],
                ['Political Savvy and Coalition Building','7m'],
                ['Driving Action and Making It Happen','5m'],
                ['Integrating the Six Disciplines','6m']
            ),[
            'video_id'      => 'HWtqAVG6',
            'summary_l1'    => 'In this foundational lesson, Michael Watkins argues that strategic thinking is not a natural talent — it\'s a discipline that can be learned, practiced, and developed. Drawing on his research with thousands of senior leaders across industries, Watkins identifies six distinct cognitive disciplines that together define what it means to think strategically. This lesson establishes the framework: strategic thinking involves being able to see patterns, understand systems, think in abstractions, envision compelling futures, navigate political realities, and translate vision into action. Most leaders are strong in one or two of these areas and underdeveloped in others. The goal of this class is to help you identify your strategic thinking gaps and develop a systematic approach to closing them.',
            'transcript_l1' => '"Ask most senior leaders what strategic thinking is and they\'ll give you a vague answer about seeing the big picture or thinking long-term. But that\'s not a definition — it\'s a description. And without a clear definition, you can\'t actually develop the skill. So let me offer one. Strategic thinking is the ability to anticipate, to see patterns, to reason across levels of abstraction, to envision compelling futures, to navigate political realities, and to drive decisive action. Six disciplines. Not one vague capability — six distinct, learnable skills. Most leaders are strong in one or two and weak in others. A great operations executive might be brilliant at driving action but blind to emerging patterns in the environment. A visionary founder might see the future clearly but struggle to build the political coalition to get there. The goal of this class is to give you a rigorous framework for understanding your own strategic thinking profile — and a practical approach to closing the gaps."',
            'prompts_l1'    => [
                'Which of the six disciplines of strategic thinking do you feel strongest in? Which is your greatest gap — and what evidence do you have for that assessment?',
                'Think of a recent strategic decision your organization made. Which of the six disciplines played the most important role? Which were underweighted?',
                'Who on your team or in your network exemplifies each of the six disciplines? What could you learn from them?',
            ],
        ]),

        ec('on-strategic-thinking-with-ai','On Strategic Thinking With AI','Michael Watkins','Professor, IMD Business School; Author, The First 90 Days',hs('men',52),$d,'Digital Leadership','2024-09-05','40m',
            lessons(['How AI Changes Strategic Analysis','6m'],['AI as a Strategic Sensing Tool','5m'],['Strategy in a World of Intelligent Machines','6m'],['Competitive Intelligence and AI','7m'],['Strategic Planning Processes in the AI Era','5m'],['Your AI-Augmented Strategy Practice','5m'],['The Strategist\'s New Toolkit','4m'])),

        ec('on-business-acumen-vs','On Business Acumen','Carla Harris','Vice Chairman & Senior Client Advisor, Morgan Stanley',hs('women',51),$d,'Business Acumen','2024-07-22','38m',
            lessons(['Financial Fluency as a Leadership Advantage','5m'],['The Language of the C-Suite','6m'],['P&L Thinking for Non-Finance Leaders','6m'],['Capital Markets and Business Strategy','5m'],['Reading the Strategic Landscape','6m'],['Your Business Acumen Development Plan','4m'])),

        ec('foresight','Foresight','Carla Harris','Vice Chairman & Senior Client Advisor, Morgan Stanley',hs('women',51),$d,'Strategic Planning','2024-05-15','36m',
            lessons(['What Foresight Requires','5m'],['Horizon Scanning Techniques','6m'],['Weak Signal Detection','5m'],['Scenario Building for Leaders','7m'],['Translating Foresight Into Strategy','6m'],['Building Your Foresight Practice','4m'])),

        ec('business-models-for-driving-innovation','Business Models for Driving Innovation','Martin Gonzalez','Organizational Psychologist, Google; Author, Competing in the Age of AI',hs('men',20),$d,'Innovation','2024-03-10','42m',
            lessons(['Why Business Models Are the Real Innovation','6m'],['The Architecture of Business Model Innovation','5m'],['Platform vs. Pipeline: The Strategic Choice','7m'],['Network Effects and Competitive Moats','5m'],['Monetization Innovation','6m'],['Testing and Iterating Your Business Model','5m'],['The Business Model Innovation Playbook','4m'])),

        ec('leading-in-complex-environments','Leading in Complex Environments','Martin Gonzalez','Organizational Psychologist, Google; Author, Competing in the Age of AI',hs('men',20),$d,'Strategic Planning','2024-01-20','40m',
            lessons(['Complexity vs. Complication','5m'],['The VUCA Framework in Practice','6m'],['Adaptive Leadership in Complex Systems','7m'],['Sense-Making at Organizational Scale','5m'],['Distributed Intelligence and Decision-Making','6m'],['Strategic Resilience','5m'],['Your Complex Environment Toolkit','4m'])),

        ec('daphne-koller-leading-to-win-vs','Leading to Win','Daphne Koller','Co-Founder, Coursera; Founder & CEO, insitro; Stanford AI Professor',hs('women',66),$d,'Vision & Strategy','2023-11-05','43m',
            lessons(['The Winning Strategy Defined','5m'],['Vision That Attracts and Aligns','6m'],['Execution as Strategy','6m'],['Building Competitive Moats','7m'],['Leading Through Strategic Uncertainty','5m'],['The Winning Culture','5m'],['Your Strategy to Win','4m'])),

        ec('resilient-to-risk-vs','Resilient to Risk','Gen. Stanley McChrystal (Ret.) & Anna Butrico','Commander & Author, Team of Teams; Aviation Risk Specialist',hs('men',86),$d,'Strategic Planning','2023-09-18','46m',
            lessons(['The Strategic Risk Environment','6m'],['Intelligence-Led Decision Making','5m'],['Organizational Resilience by Design','7m'],['Leading Through Black Swan Events','6m'],['The Strategic Communication of Risk','5m'],['Building Your Risk-Resilient Strategy','5m'],['The Commander\'s Estimate','4m'])),

        ec('no-nonsense-leadership-vs','No-Nonsense Leadership','Ben Horowitz','Co-Founder, Andreessen Horowitz; Author, The Hard Thing About Hard Things',hs('men',60),$d,'Vision & Strategy','2023-07-12','41m',
            lessons(['Peacetime vs. Wartime Strategy','6m'],['The Strategic Role of Culture','5m'],['Product Strategy and Market Positioning','6m'],['When to Pivot and When to Stay','7m'],['Competing Against Giants','5m'],['Strategic Hiring at Scale','5m'],['The Founder\'s Strategy Playbook','4m'])),

        ec('ai-and-civilization-vs','AI and the Future of Civilization','Yuval Noah Harari','Historian; Author, Sapiens, Homo Deus, 21 Lessons for the 21st Century',hs('men',81),$d,'Vision & Strategy','2023-05-22','48m',
            lessons(['The Strategic Implications of General AI','7m'],['Power, Governance, and AI Strategy','6m'],['Organizational Strategy in the Age of AI','6m'],['The Human-AI Competitive Landscape','6m'],['Long-Term Strategic Planning Under Technological Uncertainty','6m'],['The Civilizational Stakes of AI Leadership','5m'],['Strategic Leadership in the Age of Harari','4m'])),

        ec('how-to-succeed-in-business-vs','How to Succeed in Business','Kevin O\'Leary & Michael Lee','Investor, Shark Tank; Serial Entrepreneur',hs('men',64),$d,'Business Acumen','2023-03-08','44m',
            lessons(['The Business Fundamentals That Never Change','5m'],['Strategic Capital Allocation','6m'],['Competitive Positioning in Crowded Markets','6m'],['The Partnership and the Pivot','7m'],['Building Businesses That Scale','5m'],['The Exit Strategy Mindset','5m'],['Your Business Success Blueprint','4m'])),

        ec('critical-inquiry-vs','Critical Inquiry','Alex Edmans','Professor of Finance, London Business School',hs('men',44),$d,'Strategic Planning','2023-01-25','40m',
            lessons(['The Strategic Implications of Flawed Evidence','5m'],['ESG, Stakeholder Capitalism, and the Evidence','6m'],['Interrogating Your Strategy\'s Assumptions','7m'],['When the Consensus Is Wrong','5m'],['Intellectual Integrity as a Strategic Asset','6m'],['The Evidence-Based Strategist','5m'],['Building a Culture of Strategic Inquiry','4m'])),

        ec('thinking-like-a-poker-player-vs','On Thinking Like a Poker Player','Nate Silver','Statistician; Author, The Signal and the Noise',hs('men',34),$d,'Decision Making','2022-11-30','37m',
            lessons(['Strategy Under Uncertainty','5m'],['Bayesian Thinking for Strategists','6m'],['Expected Value in Strategic Decision-Making','6m'],['Competitive Strategy and Game Theory','7m'],['The Strategic Information Advantage','5m'],['Your Strategic Decision Framework','4m'])),

        ec('writing-and-strategic-communication','Communication/Writing: Lessons From a Pulitzer Prize Winner','Lawrence Wright','Pulitzer Prize-Winning Author; Staff Writer, The New Yorker',hs('men',83),$d,'Communication','2022-09-20','36m',
            lessons(['Strategic Narrative and Why It Wins','5m'],['Writing the Winning Business Case','6m'],['The Annual Report as Strategic Story','5m'],['Communicating Strategy to All Levels','6m'],['The Leader\'s Written Voice','6m'],['Your Strategic Communication Playbook','4m'])),

        ec('the-espionage-edge-vs','The Espionage Edge','Andrew Bustamante','Former CIA Covert Intelligence Officer',hs('men',38),$d,'Decision Making','2022-07-15','40m',
            lessons(['Strategic Intelligence Principles for Business','6m'],['Competitive Intelligence Operations','5m'],['The Strategic Deception Landscape','6m'],['Information Advantage as a Moat','7m'],['Intelligence-Led Strategic Planning','5m'],['Your Competitive Intelligence Playbook','5m'],['Operationalizing Strategic Insights','4m'])),

        ec('transform-org-with-ai-vs','Transform Your Organization With AI','Daphne Koller','Co-Founder, Coursera; Founder & CEO, insitro; Stanford AI Professor',hs('women',66),$d,'Digital Leadership','2022-05-10','44m',
            lessons(['The Strategic Imperative of AI','5m'],['Building an AI-First Strategy','6m'],['AI Investment Prioritization','6m'],['The AI Competitive Landscape','7m'],['Strategic Partnerships in the AI Era','5m'],['Building the AI-Powered Enterprise','5m'],['Your AI Strategy Roadmap','4m'])),

        ec('a-directors-guide-to-leadership-vs','A Director\'s Guide to Leadership','Kevin Smith','Author, Director; Storytelling & Leadership Expert',hs('men',23),$d,'Vision & Strategy','2022-03-08','36m',
            lessons(['The Director\'s Vision','5m'],['Casting Your Executive Team','6m'],['The Script as Strategic Plan','5m'],['Managing Creative Conflict at the Top','6m'],['Leading the Ensemble','5m'],['The Director\'s Strategic Legacy','5m'],['Your Leadership Director\'s Vision','4m'])),

        ec('how-to-lead-with-integrity-vs','How to Lead With Integrity','Steve Stoute','Founder & CEO, Translation; Music & Brand Strategist',hs('men',15),$d,'Ethics & Integrity','2022-01-15','38m',
            lessons(['Integrity as Strategic Differentiation','5m'],['The Reputation Economy','6m'],['When Integrity and Profit Conflict','6m'],['Building the Integrity-Driven Brand','7m'],['Integrity in Crisis','6m'],['The Integrity Leader\'s Legacy','4m'])),

        ec('the-strategic-leaders-mindset','The Strategic Leader\'s Mindset','Dr. Claire Abbott','Professor of Strategic Leadership, Oxford Saïd Business School',hs('women',53),$d,'Strategic Planning','2021-11-22','37m',
            lessons(['The Strategic Mindset Defined','5m'],['Long-Term Thinking in a Short-Term World','6m'],['The Ambidextrous Strategist','5m'],['Strategic Conversations and How to Lead Them','6m'],['Strategic Courage','6m'],['Building Your Strategic Leadership Identity','5m'],['The Mindset Blueprint','4m'])),

        ec('scenario-planning-for-uncertain-times','Scenario Planning for Uncertain Times','Dr. Raymond Chen','Futures Research Scientist; Former Shell Global Scenarios Team',hs('men',44),$d,'Strategic Planning','2021-09-10','39m',
            lessons(['The Limits of Forecasting','5m'],['The Scenario Planning Process','6m'],['Building Your Three Strategic Scenarios','7m'],['Using Scenarios to Test Strategy','5m'],['Leading Strategy Reviews With Scenarios','6m'],['Your Scenario Planning Capability','5m'],['Scenarios as Ongoing Strategic Practice','4m'])),

        ec('building-your-leadership-brand','Building Your Leadership Brand','Monica Stein','Executive Coach; Author, The Leader Brand',hs('women',61),$d,'Personal Effectiveness','2021-07-05','33m',
            lessons(['Why Your Leadership Brand Matters','5m'],['Defining Your Leadership Identity','5m'],['Visibility and Influence','6m'],['The Leadership Brand Online','5m'],['Consistency and Authenticity','6m'],['Your Leadership Brand Strategy','4m'])),

        ec('the-decision-advantage','The Decision Advantage','Dr. Victor Osei','Decision Scientist; Author, Decisive at Scale',hs('men',22),$d,'Decision Making','2021-05-01','36m',
            lessons(['The Anatomy of a Strategic Decision','5m'],['Cognitive Biases in the Boardroom','6m'],['Decision Processes That Work','5m'],['Speed vs. Quality in Decision-Making','6m'],['Group Decision Dynamics','6m'],['Your Decision Architecture','4m'])),

        ec('leading-with-data','Leading With Data','Dr. Priya Krishnan','Data Strategy Expert; Author, The Data-Intelligent Leader',hs('women',47),$d,'Decision Making','2021-03-18','37m',
            lessons(['The Data-Driven Leader Defined','5m'],['Building Data Literacy Across the Organization','6m'],['Data Strategy and Its Business Impact','6m'],['The Ethics of Data-Driven Decisions','5m'],['Leading With Dashboards and Narratives','6m'],['Your Data Leadership Roadmap','5m'],['Data Culture at Scale','4m'])),

        ec('systemic-thinking-for-executives','Systemic Thinking for Executives','Dr. Anna Hoffman','Systems Dynamics Researcher; Author, The Systems Leader',hs('women',64),$d,'Strategic Planning','2021-01-12','38m',
            lessons(['What Systems Thinking Changes','5m'],['Feedback Loops and Organizational Dynamics','6m'],['Unintended Consequences of Strategic Decisions','7m'],['Leverage Points and High-Impact Interventions','5m'],['Systemic Problem-Solving','6m'],['The Systemic Strategy','5m'],['Your Systems Thinking Practice','4m'])),

        ec('the-visionary-leader','The Visionary Leader','James Okafor','Organizational Scientist; Leadership Coach',hs('men',12),$d,'Vision & Strategy','2020-11-05','34m',
            lessons(['What Vision Actually Is','5m'],['Creating a Vision That Moves People','6m'],['Communicating Vision at Every Level','5m'],['Vision and Execution: Closing the Gap','6m'],['Evolving Vision Without Losing Trust','6m'],['Your Vision Statement','3m'])),

        ec('long-term-thinking','Long-Term Thinking in a Short-Term World','Dr. Patricia Lin','Futurist; Author, The Long Game',hs('women',70),$d,'Vision & Strategy','2020-09-01','35m',
            lessons(['Why Leaders Default to Short-Term','5m'],['The Long Game: A Framework','6m'],['Balancing Now and Next','5m'],['Long-Term Investments in Culture and Capability','6m'],['Communicating Long-Term Thinking to Short-Term Stakeholders','6m'],['Your Long-Term Leadership Agenda','4m'])),

        ec('competitive-strategy-reimagined','Competitive Strategy Reimagined','Robert Ashby','Professor of Strategy, London Business School',hs('men',76),$d,'Strategic Planning','2020-07-10','40m',
            lessons(['Porter\'s Five Forces in the AI Age','6m'],['Blue Ocean vs. Red Ocean: Updated','5m'],['Platform Competition and New Moats','7m'],['Ecosystem Strategy','5m'],['Dynamic Capabilities','6m'],['The Agile Strategy Cycle','5m'],['Your Competitive Strategy Canvas','4m'])),

        ec('leading-organizational-alignment','Leading Organizational Alignment','Dr. Diane Torres','Organizational Effectiveness Researcher; Author, One Direction',hs('women',49),$d,'Strategic Planning','2020-05-05','36m',
            lessons(['Misalignment and Its Cost','5m'],['The Alignment Diagnostic','6m'],['Cascading Strategy Through the Organization','6m'],['Aligning Structure, Process, and People','5m'],['The Alignment Conversation','6m'],['Sustaining Alignment','4m'])),

        ec('from-manager-to-strategist','From Manager to Strategist','Alex Hammond','Leadership Transition Coach; Author, The Strategic Leap',hs('men',14),$d,'Vision & Strategy','2020-03-01','33m',
            lessons(['The Manager-Strategist Divide','5m'],['Developing Strategic Intelligence','5m'],['Gaining Visibility and Influence','5m'],['Strategic Communication Up the Chain','6m'],['Making Strategic Decisions Before You Have Authority','6m'],['Your Strategic Transition Plan','4m'])),

        ec('on-communication-for-leaders','Communication for Visionary Leaders','Jefferson Fisher','Trial Attorney; Communication Expert',hs('men',28),$d,'Communication','2020-01-15','34m',
            lessons(['Vision Communication That Inspires','5m'],['The Leader\'s Narrative Arc','5m'],['Persuasion at the Executive Level','6m'],['Communicating in Times of Strategic Uncertainty','6m'],['Your Leadership Communication System','6m'],['The Vision Presentation','4m'])),

    ];
}
